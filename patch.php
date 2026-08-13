<?php
$modules = [
    'PharmacyWard',
    'WardClass',
    'ConsultationWard',
    'LaboratoryWard',
    'OperatingWard',
    'RadiologyWard',
    'ScannedDocument',
    'PatientPhoto',
    'EmployeePhoto'
];

foreach ($modules as $eng) {
    $full = "General$eng";
    $dir = __DIR__ . "/Modules/$full";
    $lcEng = strtolower($eng);
    $table_prefix = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $eng)) . 's'; // simple pluralize

    // 1. MIGRATION
    $mig_dir = "$dir/database/migrations";
    if (is_dir($mig_dir)) {
        $files = glob("$mig_dir/*_create_*.php");
        if (!empty($files)) {
            $mig_file = $files[0];
            $content = file_get_contents($mig_file);
            $content = preg_replace(
                '/\$table->id\(\);\s*\$table->timestamps\(\);/s',
                "\$table->id();\n            \$table->string('name');\n            \$table->boolean('is_active')->default(true);\n            \$table->timestamps();",
                $content
            );
            file_put_contents($mig_file, $content);
        }
    }

    // 2. MODEL
    $model_file = "$dir/app/Models/$eng.php";
    if (file_exists($model_file)) {
        $content = file_get_contents($model_file);
        $content = str_replace(
            "protected \$fillable = [];",
            "protected \$fillable = ['name', 'is_active'];",
            $content
        );
        $content = str_replace(
            "// protected static function newFactory(): {$eng}Factory\n    // {\n    //     // return {$eng}Factory::new();\n    // }",
            "protected static function newFactory(): {$eng}Factory\n    {\n        return {$eng}Factory::new();\n    }",
            $content
        );
        $content = str_replace(
            "use Illuminate\Database\Eloquent\Factories\HasFactory;",
            "use Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Modules\\$full\\Database\\Factories\\{$eng}Factory;",
            $content
        );
        file_put_contents($model_file, $content);
    }

    // 3. FACTORY
    $factory_file = "$dir/database/factories/{$eng}Factory.php";
    if (file_exists($factory_file)) {
        $content = file_get_contents($factory_file);
        $content = str_replace(
            "return [];",
            "return [\n            'name' => fake()->name(),\n            'is_active' => fake()->boolean(90),\n        ];",
            $content
        );
        file_put_contents($factory_file, $content);
    }

    // 4. CONTROLLER
    $ctrl_file = "$dir/app/Http/Controllers/{$eng}Controller.php";
    if (file_exists($ctrl_file)) {
        $content = file_get_contents($ctrl_file);
        $content = str_replace(
            "use Illuminate\Http\Request;",
            "use Illuminate\Http\Request;\nuse Modules\\$full\\Models\\$eng;",
            $content
        );
        $content = preg_replace(
            '/public function index\(\).*?public function store/s',
            "public function index()\n    {\n        return response()->json(['data' => $eng::all()]);\n    }\n\n    public function store",
            $content
        );
        $content = preg_replace(
            '/public function store\(Request \$request\).*?public function show/s',
            "public function store(Request \$request)\n    {\n        \$validated = \$request->validate(['name' => 'required|string', 'is_active' => 'boolean']);\n        \$model = $eng::create(\$validated);\n        return response()->json(['data' => \$model], 201);\n    }\n\n    public function show",
            $content
        );
        $content = preg_replace(
            '/public function show\(\$id\).*?public function update/s',
            "public function show(\$id)\n    {\n        return response()->json(['data' => $eng::findOrFail(\$id)]);\n    }\n\n    public function update",
            $content
        );
        $content = preg_replace(
            '/public function update\(Request \$request, \$id\).*?public function destroy/s',
            "public function update(Request \$request, \$id)\n    {\n        \$validated = \$request->validate(['name' => 'required|string', 'is_active' => 'boolean']);\n        \$model = $eng::findOrFail(\$id);\n        \$model->update(\$validated);\n        return response()->json(['data' => \$model]);\n    }\n\n    public function destroy",
            $content
        );
        $content = preg_replace(
            '/public function destroy\(\$id\).*?\}/s',
            "public function destroy(\$id)\n    {\n        \$model = $eng::findOrFail(\$id);\n        \$model->delete();\n        return response()->json(null, 204);\n    }\n}",
            $content
        );
        file_put_contents($ctrl_file, $content);
    }

    // 5. API ROUTES
    $api_file = "$dir/routes/api.php";
    if (file_exists($api_file)) {
        $content = file_get_contents($api_file);
        $content = preg_replace(
            '/Route::middleware.*?\}\);/s',
            "Route::apiResource('{$table_prefix}', {$eng}Controller::class)->names('general{$lcEng}.{$table_prefix}');",
            $content
        );
        file_put_contents($api_file, $content);
    }

    // 6. TEST
    $test_file = "$dir/tests/Feature/{$eng}Test.php";
    if (file_exists($test_file)) {
        $content = "<?php\n\nnamespace Modules\\$full\\Tests\\Feature;\n\nuse Tests\\TestCase;\nuse Modules\\$full\\Models\\$eng;\nuse Illuminate\\Foundation\\Testing\\RefreshDatabase;\n\nclass {$eng}Test extends TestCase\n{\n    use RefreshDatabase;\n\n    public function test_can_list()\n    {\n        $eng::factory()->count(3)->create();\n        \$response = \$this->getJson('/api/{$table_prefix}');\n        \$response->assertStatus(200)->assertJsonCount(3, 'data');\n    }\n\n    public function test_can_create()\n    {\n        \$data = $eng::factory()->make()->toArray();\n        \$response = \$this->postJson('/api/{$table_prefix}', \$data);\n        \$response->assertStatus(201);\n        \$this->assertDatabaseHas('{$table_prefix}', ['name' => \$data['name']]);\n    }\n\n    public function test_can_show()\n    {\n        \$model = $eng::factory()->create();\n        \$response = \$this->getJson(\"/api/{$table_prefix}/{\$model->id}\");\n        \$response->assertStatus(200)->assertJsonPath('data.name', \$model->name);\n    }\n\n    public function test_can_update()\n    {\n        \$model = $eng::factory()->create();\n        \$response = \$this->putJson(\"/api/{$table_prefix}/{\$model->id}\", [\n            'name' => 'Updated Name',\n            'is_active' => true,\n        ]);\n        \$response->assertStatus(200);\n        \$this->assertDatabaseHas('{$table_prefix}', ['name' => 'Updated Name']);\n    }\n\n    public function test_can_delete()\n    {\n        \$model = $eng::factory()->create();\n        \$response = \$this->deleteJson(\"/api/{$table_prefix}/{\$model->id}\");\n        \$response->assertStatus(204);\n        \$this->assertDatabaseMissing('{$table_prefix}', ['id' => \$model->id]);\n    }\n}\n";
        file_put_contents($test_file, $content);
    }
}
echo "Patched successfully.\n";

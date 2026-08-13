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
    $ctrl_file = __DIR__ . "/Modules/$full/app/Http/Controllers/{$eng}Controller.php";
    if (file_exists($ctrl_file)) {
        $content = file_get_contents($ctrl_file);
        // Remove trailing newlines and '}' at the end of the file
        // Specifically looking for "}\n}" at the end of the file
        $content = preg_replace("/\\}\\s*\\}\\s*$/s", "}\n", $content);
        file_put_contents($ctrl_file, $content);
    }
}
echo "Controllers fixed successfully.\n";

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
    $api_file = __DIR__ . "/Modules/$full/routes/api.php";
    if (file_exists($api_file)) {
        $content = file_get_contents($api_file);
        
        // Remove the default generated import
        $content = preg_replace("/use Modules\\\\$full\\\\Http\\\\Controllers\\\\{$full}Controller;\n?/", "", $content);
        
        // Check if the correct import exists
        if (strpos($content, "use Modules\\$full\\Http\\Controllers\\{$eng}Controller;") === false) {
            // Insert it after the Route import
            $content = str_replace(
                "use Illuminate\\Support\\Facades\\Route;",
                "use Illuminate\\Support\\Facades\\Route;\nuse Modules\\$full\\Http\\Controllers\\{$eng}Controller;",
                $content
            );
        }
        file_put_contents($api_file, $content);
    }
}
echo "API imports patched successfully.\n";

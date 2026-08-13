<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$reflector = new ReflectionClass('Modules\PendaftaranReservation\Models\Reservation');
echo $reflector->getFileName();

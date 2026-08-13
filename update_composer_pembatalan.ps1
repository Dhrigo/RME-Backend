$json = Get-Content composer.json | ConvertFrom-Json

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanFinalResult\' -Value 'Modules/PembatalanFinalResult/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanFinalResult\Database\Factories\' -Value 'Modules/PembatalanFinalResult/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanFinalResult\Database\Seeders\' -Value 'Modules/PembatalanFinalResult/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanFinalResult\Tests\' -Value 'Modules/PembatalanFinalResult/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanDocumentCancellation\' -Value 'Modules/PembatalanDocumentCancellation/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanDocumentCancellation\Database\Factories\' -Value 'Modules/PembatalanDocumentCancellation/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanDocumentCancellation\Database\Seeders\' -Value 'Modules/PembatalanDocumentCancellation/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanDocumentCancellation\Tests\' -Value 'Modules/PembatalanDocumentCancellation/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanMedicalRecordCancellation\' -Value 'Modules/PembatalanMedicalRecordCancellation/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanMedicalRecordCancellation\Database\Factories\' -Value 'Modules/PembatalanMedicalRecordCancellation/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanMedicalRecordCancellation\Database\Seeders\' -Value 'Modules/PembatalanMedicalRecordCancellation/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanMedicalRecordCancellation\Tests\' -Value 'Modules/PembatalanMedicalRecordCancellation/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanReturnCancellation\' -Value 'Modules/PembatalanReturnCancellation/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanReturnCancellation\Database\Factories\' -Value 'Modules/PembatalanReturnCancellation/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanReturnCancellation\Database\Seeders\' -Value 'Modules/PembatalanReturnCancellation/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\PembatalanReturnCancellation\Tests\' -Value 'Modules/PembatalanReturnCancellation/tests/'

$json | ConvertTo-Json -Depth 10 | Set-Content composer.json
composer dump-autoload

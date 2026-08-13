$json = Get-Content composer.json | ConvertFrom-Json

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimFile\' -Value 'Modules/BerkasKlaimClaimFile/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimFile\Database\Factories\' -Value 'Modules/BerkasKlaimClaimFile/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimFile\Database\Seeders\' -Value 'Modules/BerkasKlaimClaimFile/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimFile\Tests\' -Value 'Modules/BerkasKlaimClaimFile/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimSupportingDocument\' -Value 'Modules/BerkasKlaimSupportingDocument/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimSupportingDocument\Database\Factories\' -Value 'Modules/BerkasKlaimSupportingDocument/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimSupportingDocument\Database\Seeders\' -Value 'Modules/BerkasKlaimSupportingDocument/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimSupportingDocument\Tests\' -Value 'Modules/BerkasKlaimSupportingDocument/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompleteness\' -Value 'Modules/BerkasKlaimClaimCompleteness/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompleteness\Database\Factories\' -Value 'Modules/BerkasKlaimClaimCompleteness/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompleteness\Database\Seeders\' -Value 'Modules/BerkasKlaimClaimCompleteness/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompleteness\Tests\' -Value 'Modules/BerkasKlaimClaimCompleteness/tests/'

$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompletenessComment\' -Value 'Modules/BerkasKlaimClaimCompletenessComment/app/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompletenessComment\Database\Factories\' -Value 'Modules/BerkasKlaimClaimCompletenessComment/database/factories/'
$json.autoload.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompletenessComment\Database\Seeders\' -Value 'Modules/BerkasKlaimClaimCompletenessComment/database/seeders/'
$json.'autoload-dev'.'psr-4' | Add-Member -MemberType NoteProperty -Name 'Modules\BerkasKlaimClaimCompletenessComment\Tests\' -Value 'Modules/BerkasKlaimClaimCompletenessComment/tests/'

$json | ConvertTo-Json -Depth 10 | Set-Content composer.json
composer dump-autoload

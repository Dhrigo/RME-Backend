<?php

namespace Modules\GeneralRegion\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class RegionController extends Controller
{
    public function provinces()
    {
        return Province::query()->orderBy('name')->get(['code', 'name']);
    }

    public function cities(string $provinceCode)
    {
        return City::query()->where('province_code', $provinceCode)->orderBy('name')->get(['code', 'name']);
    }

    public function districts(string $cityCode)
    {
        return District::query()->where('city_code', $cityCode)->orderBy('name')->get(['code', 'name']);
    }

    public function villages(string $districtCode)
    {
        return Village::query()->where('district_code', $districtCode)->orderBy('name')->get(['id', 'code', 'name']);
    }
}

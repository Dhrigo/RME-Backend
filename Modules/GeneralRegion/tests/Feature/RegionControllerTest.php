<?php

namespace Modules\GeneralRegion\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Modules\Auth\Models\User;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_provinces(): void
    {
        $this->actingUser();
        Province::create(['code' => '31', 'name' => 'DKI Jakarta']);

        $this->getJson('/api/v1/regions/provinces')
            ->assertOk()
            ->assertJsonFragment(['name' => 'DKI Jakarta']);
    }

    public function test_it_cascades_down_to_villages(): void
    {
        $this->actingUser();
        Province::create(['code' => '31', 'name' => 'DKI Jakarta']);
        City::create(['code' => '3171', 'province_code' => '31', 'name' => 'Jakarta Selatan']);
        District::create(['code' => '3171010', 'city_code' => '3171', 'name' => 'Tebet']);
        Village::create(['code' => '3171010001', 'district_code' => '3171010', 'name' => 'Menteng Dalam']);

        $this->getJson('/api/v1/regions/provinces/31/cities')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Jakarta Selatan']);

        $this->getJson('/api/v1/regions/cities/3171/districts')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Tebet']);

        $this->getJson('/api/v1/regions/districts/3171010/villages')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Menteng Dalam']);
    }
}

<?php

namespace Tests\Unit\Models;

use Tests\TestCase as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\City;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_city_has_title_attribute()
    {
        $city = factory(City::class)->create([
            'name' => 'KABUPATEN KLATEN'
        ]);

        $this->assertEquals('Kabupaten Klaten', $city->title);
    }
}

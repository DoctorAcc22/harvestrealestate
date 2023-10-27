<?php

namespace Tests\Feature\API\AmenityAPI;

use Tests\TestCase;
use App\Models\User;
use App\Models\Amenity;

class AmenityAPITest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_amenity_api_call_store_expect_successful()
    {
        $password = '1234567890';
        $user = User::factory()->create(['password' => $password]);

        $this->actingAs($user);
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', array_merge($user->toArray(), ['password' => $password]));

        $api->assertStatus(200);

        
        $amenityArr = [
            'code' => '001',
            'name' => 'School',
            'status' => 1,
        ];

        $api = $this->json('POST', 'api/amenity/save', $amenityArr);

        $api->assertSuccessful();
        $this->assertDatabaseHas('amenities', [
            'code' => $amenityArr['code'],
            'name' => $amenityArr['name'],
            'status' => $amenityArr['status'],
        ]);
    }
}

<?php

namespace Tests\Feature\API\AmenityAPI;

use App\Models\Amenity;
use App\Models\User;
use Tests\TestCase;

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
            'code' => strtoupper(fake()->lexify()).fake()->numerify(),
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

    public function test_amenity_api_call_read_expect_successful()
    {
        $amenity = new Amenity();
        $amenity->code = strtoupper(fake()->lexify()).fake()->numerify();
        $amenity->name = 'Hospital';
        $amenity->status = 1;
        $amenity->save();

        $password = '1234567890';
        $user = User::factory()->create(['password' => $password]);

        $this->actingAs($user);
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', array_merge($user->toArray(), ['password' => $password]));

        $api->assertStatus(200);

        $api = $this->json('GET', 'api/amenity/read');

        $api->assertSuccessful();

        $result = json_decode($api->baseResponse->getContent(), true);
        $found = false;
        for($i = 0; $i < count($result['amenities']); $i++) {
            if ($result['amenities'][$i]['code'] == $amenity->code && $result['amenities'][$i]['name'] == $amenity->name ) {
                $found = true;
            }
        }

        $this->asserttrue($found == true);
    }

    public function test_amenity_api_call_update_expect_successful()
    {
        $amenity = new Amenity();
        $amenity->code = strtoupper(fake()->lexify()).fake()->numerify();
        $amenity->name = 'Hospital';
        $amenity->status = 1;
        $amenity->save();

        $password = '1234567890';
        $user = User::factory()->create(['password' => $password]);

        $this->actingAs($user);
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', array_merge($user->toArray(), ['password' => $password]));

        $api->assertStatus(200);

        $amenityArr = [
            'code' => strtoupper(fake()->lexify()).fake()->numerify(),
            'name' => 'School X',
            'status' => 1,
        ];

        $api = $this->json('POST', 'api/amenity/edit/'.$amenity->id, $amenityArr);

        $api->assertSuccessful();
        $this->assertDatabaseHas('amenities', [
            'code' => $amenityArr['code'],
            'name' => $amenityArr['name'],
            'status' => $amenityArr['status'],
        ]);
    }

    public function test_amenity_api_call_delete_expect_successful()
    {
        $amenity = new Amenity();
        $amenity->code = strtoupper(fake()->lexify()).fake()->numerify();
        $amenity->name = 'Swimming Pool';
        $amenity->status = 1;
        $amenity->save();

        $password = '1234567890';
        $user = User::factory()->create(['password' => $password]);

        $this->actingAs($user);
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', array_merge($user->toArray(), ['password' => $password]));

        $api->assertStatus(200);

        $amenityArr = [
            'code' => strtoupper(fake()->lexify()).fake()->numerify(),
            'name' => 'Swimming Pool X',
            'status' => 1,
        ];

        $api = $this->json('POST', 'api/amenity/delete/'.$amenity->id, $amenityArr);

        $api->assertSuccessful();
        $this->assertSoftDeleted('amenities', [
            'id' => $amenity->id,
        ]);
    }
}

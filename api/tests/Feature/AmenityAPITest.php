<?php

namespace Tests\Feature\API\AmenityAPI;

use App\Models\Amenity;
use Tests\TestCase;

class AmenityAPITest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_amenity_api_call_store_expect_successful()
    {
        $amenityArr = Amenity::make([
            'code' => '123',
            'name' => 'dika',
            'status' => 1,
        ])->toArray();

        $api = $this->json('POST', route('api.post.db.amenity.amenity.save'), $amenityArr);

        $api->assertSuccessful();
        $this->assertDatabaseHas('amenities', [
            'code' => $amenityArr['code'],
            'name' => $amenityArr['name'],
            'status' => $amenityArr['status'],
        ]);
    }
}

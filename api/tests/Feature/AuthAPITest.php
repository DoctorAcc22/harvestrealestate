<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthAPITest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_auth_api_call_register_expect_successful()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = '1234567890';

        $api = $this->json('POST', 'api/register', $user);

        $api->assertStatus(200);
    }

    public function test_auth_api_call_login_expect_successful()
    {    
        $password = '1234567890';
        $user = User::factory()->create(['password' => $password])->toArray();        
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', $user);

        $api->assertStatus(200);
    }

    public function test_auth_api_call_logout_expect_successful()
    {
        $password = '1234567890';
        $user = User::factory()->create(['password' => $password]);
        
        $this->actingAs($user);
        $user['password'] = $password;

        $api = $this->json('POST', 'api/login', array_merge($user->toArray(), ['password' => $password]));
        
        $api->assertStatus(200);

        $bearerToken = $api->decodeResponseJson()['access_token'];

        $api = $this->json('POST', 'api/logout', [$bearerToken]);
        
        $api->assertStatus(200);        
    }
}

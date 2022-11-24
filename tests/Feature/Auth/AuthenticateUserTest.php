<?php

namespace Tests\Feature\Auth;

use DateTime;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Illuminate\Http\Response;

uses(RefreshDatabase::class);

test('users can authenticate using the login screen', function () {                
    // Given
    $clientRepository = new ClientRepository();
    $client = $clientRepository->createPersonalAccessClient(
        null, 'Test Personal Access Client', 'http://localhost'
    );

    DB::table('oauth_personal_access_clients')->insert([
        'client_id' => $client->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ]);
    
    $user = User::factory()->create([
        'email' => 'john@doe.com'
    ]);

    // When
    $response = $this->post(route('user.login'), [
        'email' => 'john@doe.com',
        'password' => 'password',    
    ]);        

    // Then
    $response->assertStatus(200);
        
});

test('users can not authenticate with invalid creds', function () {
    // Given
    $clientRepository = new ClientRepository();
    $client = $clientRepository->createPersonalAccessClient(
        null, 'Test Personal Access Client', 'http://localhost'
    );

    DB::table('oauth_personal_access_clients')->insert([
        'client_id' => $client->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ]);
    
    $user = User::factory()->create([
        'email' => 'john1@doe.com' //Given typo error
    ]);

    // When
    $response = $this->post(route('user.login'), [
        'email' => 'john@doe.com',
        'password' => 'password',    
    ]);        
    
    // Then
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('users can not authenticate with invalid input format', function () {
    // Given
    $clientRepository = new ClientRepository();
    $client = $clientRepository->createPersonalAccessClient(
        null, 'Test Personal Access Client', 'http://localhost'
    );

    DB::table('oauth_personal_access_clients')->insert([
        'client_id' => $client->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ]);
    
    $user = User::factory()->create([
        'email' => 'john1@doe.com'
    ]);

    // When
    $response = $this->post(route('user.login'), [
        'email' => 'john', //Given typo error
        'password' => 'password',    
    ]);        
    
    // Then
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

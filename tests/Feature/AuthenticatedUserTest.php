<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed([

    ]);
});

test('User with valid credential can execute Test Api with passport middleware', function () {
    // Given
    $user = User::factory()->create();
    // When
    $response = $this->actingAs($user, 'api')->get(route('user.test'));    
    // Then
    $response->assertStatus(200);
    // And
    $response->assertJsonStructure([
        'test'
    ]);
});


test('User with invalid credential can\'t execute Test Api with passport middleware', function () {
    // Given
    $user = User::factory()->create();
    // When
    $response = $this->get(route('user.test'));    
    // Then
    $response->assertStatus(500);    
});

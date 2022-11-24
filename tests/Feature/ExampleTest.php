<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed([

    ]);
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

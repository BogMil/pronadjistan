<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UniverzalnaPretragaControllerTest extends TestCase
{
    /** @test */
    public function savePretraga()
    {
        $response = $this->post('/api/univerzalnaPretraga');
        $response->assertStatus(200);
    }

}

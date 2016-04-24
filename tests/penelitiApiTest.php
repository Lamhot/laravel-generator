<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class penelitiApiTest extends TestCase
{
    use MakepenelitiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepeneliti()
    {
        $peneliti = $this->fakepenelitiData();
        $this->json('POST', '/api/v1/penelitis', $peneliti);

        $this->assertApiResponse($peneliti);
    }

    /**
     * @test
     */
    public function testReadpeneliti()
    {
        $peneliti = $this->makepeneliti();
        $this->json('GET', '/api/v1/penelitis/'.$peneliti->id);

        $this->assertApiResponse($peneliti->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepeneliti()
    {
        $peneliti = $this->makepeneliti();
        $editedpeneliti = $this->fakepenelitiData();

        $this->json('PUT', '/api/v1/penelitis/'.$peneliti->id, $editedpeneliti);

        $this->assertApiResponse($editedpeneliti);
    }

    /**
     * @test
     */
    public function testDeletepeneliti()
    {
        $peneliti = $this->makepeneliti();
        $this->json('DELETE', '/api/v1/penelitis/'.$peneliti->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/penelitis/'.$peneliti->id);

        $this->assertResponseStatus(404);
    }
}

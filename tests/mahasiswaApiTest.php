<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mahasiswaApiTest extends TestCase
{
    use MakemahasiswaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemahasiswa()
    {
        $mahasiswa = $this->fakemahasiswaData();
        $this->json('POST', '/api/v1/mahasiswas', $mahasiswa);

        $this->assertApiResponse($mahasiswa);
    }

    /**
     * @test
     */
    public function testReadmahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $this->json('GET', '/api/v1/mahasiswas/'.$mahasiswa->id);

        $this->assertApiResponse($mahasiswa->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $editedmahasiswa = $this->fakemahasiswaData();

        $this->json('PUT', '/api/v1/mahasiswas/'.$mahasiswa->id, $editedmahasiswa);

        $this->assertApiResponse($editedmahasiswa);
    }

    /**
     * @test
     */
    public function testDeletemahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $this->json('DELETE', '/api/v1/mahasiswas/'.$mahasiswa->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mahasiswas/'.$mahasiswa->id);

        $this->assertResponseStatus(404);
    }
}

<?php

use App\Models\mahasiswa;
use App\Repositories\mahasiswaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mahasiswaRepositoryTest extends TestCase
{
    use MakemahasiswaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var mahasiswaRepository
     */
    protected $mahasiswaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mahasiswaRepo = App::make(mahasiswaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemahasiswa()
    {
        $mahasiswa = $this->fakemahasiswaData();
        $createdmahasiswa = $this->mahasiswaRepo->create($mahasiswa);
        $createdmahasiswa = $createdmahasiswa->toArray();
        $this->assertArrayHasKey('id', $createdmahasiswa);
        $this->assertNotNull($createdmahasiswa['id'], 'Created mahasiswa must have id specified');
        $this->assertNotNull(mahasiswa::find($createdmahasiswa['id']), 'mahasiswa with given id must be in DB');
        $this->assertModelData($mahasiswa, $createdmahasiswa);
    }

    /**
     * @test read
     */
    public function testReadmahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $dbmahasiswa = $this->mahasiswaRepo->find($mahasiswa->id);
        $dbmahasiswa = $dbmahasiswa->toArray();
        $this->assertModelData($mahasiswa->toArray(), $dbmahasiswa);
    }

    /**
     * @test update
     */
    public function testUpdatemahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $fakemahasiswa = $this->fakemahasiswaData();
        $updatedmahasiswa = $this->mahasiswaRepo->update($fakemahasiswa, $mahasiswa->id);
        $this->assertModelData($fakemahasiswa, $updatedmahasiswa->toArray());
        $dbmahasiswa = $this->mahasiswaRepo->find($mahasiswa->id);
        $this->assertModelData($fakemahasiswa, $dbmahasiswa->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemahasiswa()
    {
        $mahasiswa = $this->makemahasiswa();
        $resp = $this->mahasiswaRepo->delete($mahasiswa->id);
        $this->assertTrue($resp);
        $this->assertNull(mahasiswa::find($mahasiswa->id), 'mahasiswa should not exist in DB');
    }
}

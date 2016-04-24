<?php

use App\Models\peneliti;
use App\Repositories\penelitiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class penelitiRepositoryTest extends TestCase
{
    use MakepenelitiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var penelitiRepository
     */
    protected $penelitiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->penelitiRepo = App::make(penelitiRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepeneliti()
    {
        $peneliti = $this->fakepenelitiData();
        $createdpeneliti = $this->penelitiRepo->create($peneliti);
        $createdpeneliti = $createdpeneliti->toArray();
        $this->assertArrayHasKey('id', $createdpeneliti);
        $this->assertNotNull($createdpeneliti['id'], 'Created peneliti must have id specified');
        $this->assertNotNull(peneliti::find($createdpeneliti['id']), 'peneliti with given id must be in DB');
        $this->assertModelData($peneliti, $createdpeneliti);
    }

    /**
     * @test read
     */
    public function testReadpeneliti()
    {
        $peneliti = $this->makepeneliti();
        $dbpeneliti = $this->penelitiRepo->find($peneliti->id);
        $dbpeneliti = $dbpeneliti->toArray();
        $this->assertModelData($peneliti->toArray(), $dbpeneliti);
    }

    /**
     * @test update
     */
    public function testUpdatepeneliti()
    {
        $peneliti = $this->makepeneliti();
        $fakepeneliti = $this->fakepenelitiData();
        $updatedpeneliti = $this->penelitiRepo->update($fakepeneliti, $peneliti->id);
        $this->assertModelData($fakepeneliti, $updatedpeneliti->toArray());
        $dbpeneliti = $this->penelitiRepo->find($peneliti->id);
        $this->assertModelData($fakepeneliti, $dbpeneliti->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepeneliti()
    {
        $peneliti = $this->makepeneliti();
        $resp = $this->penelitiRepo->delete($peneliti->id);
        $this->assertTrue($resp);
        $this->assertNull(peneliti::find($peneliti->id), 'peneliti should not exist in DB');
    }
}

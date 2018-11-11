<?php

use App\Models\ParentDetail;
use App\Repositories\ParentDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParentDetailRepositoryTest extends TestCase
{
    use MakeParentDetailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ParentDetailRepository
     */
    protected $parentDetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->parentDetailRepo = App::make(ParentDetailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateParentDetail()
    {
        $parentDetail = $this->fakeParentDetailData();
        $createdParentDetail = $this->parentDetailRepo->create($parentDetail);
        $createdParentDetail = $createdParentDetail->toArray();
        $this->assertArrayHasKey('id', $createdParentDetail);
        $this->assertNotNull($createdParentDetail['id'], 'Created ParentDetail must have id specified');
        $this->assertNotNull(ParentDetail::find($createdParentDetail['id']), 'ParentDetail with given id must be in DB');
        $this->assertModelData($parentDetail, $createdParentDetail);
    }

    /**
     * @test read
     */
    public function testReadParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $dbParentDetail = $this->parentDetailRepo->find($parentDetail->id);
        $dbParentDetail = $dbParentDetail->toArray();
        $this->assertModelData($parentDetail->toArray(), $dbParentDetail);
    }

    /**
     * @test update
     */
    public function testUpdateParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $fakeParentDetail = $this->fakeParentDetailData();
        $updatedParentDetail = $this->parentDetailRepo->update($fakeParentDetail, $parentDetail->id);
        $this->assertModelData($fakeParentDetail, $updatedParentDetail->toArray());
        $dbParentDetail = $this->parentDetailRepo->find($parentDetail->id);
        $this->assertModelData($fakeParentDetail, $dbParentDetail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $resp = $this->parentDetailRepo->delete($parentDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(ParentDetail::find($parentDetail->id), 'ParentDetail should not exist in DB');
    }
}

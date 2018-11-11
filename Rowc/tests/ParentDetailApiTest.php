<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParentDetailApiTest extends TestCase
{
    use MakeParentDetailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateParentDetail()
    {
        $parentDetail = $this->fakeParentDetailData();
        $this->json('POST', '/api/v1/parentDetails', $parentDetail);

        $this->assertApiResponse($parentDetail);
    }

    /**
     * @test
     */
    public function testReadParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $this->json('GET', '/api/v1/parentDetails/'.$parentDetail->id);

        $this->assertApiResponse($parentDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $editedParentDetail = $this->fakeParentDetailData();

        $this->json('PUT', '/api/v1/parentDetails/'.$parentDetail->id, $editedParentDetail);

        $this->assertApiResponse($editedParentDetail);
    }

    /**
     * @test
     */
    public function testDeleteParentDetail()
    {
        $parentDetail = $this->makeParentDetail();
        $this->json('DELETE', '/api/v1/parentDetails/'.$parentDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/parentDetails/'.$parentDetail->id);

        $this->assertResponseStatus(404);
    }
}

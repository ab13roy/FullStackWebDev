<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailTmplateApiTest extends TestCase
{
    use MakeEmailTmplateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmailTmplate()
    {
        $emailTmplate = $this->fakeEmailTmplateData();
        $this->json('POST', '/api/v1/emailTmplates', $emailTmplate);

        $this->assertApiResponse($emailTmplate);
    }

    /**
     * @test
     */
    public function testReadEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $this->json('GET', '/api/v1/emailTmplates/'.$emailTmplate->id);

        $this->assertApiResponse($emailTmplate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $editedEmailTmplate = $this->fakeEmailTmplateData();

        $this->json('PUT', '/api/v1/emailTmplates/'.$emailTmplate->id, $editedEmailTmplate);

        $this->assertApiResponse($editedEmailTmplate);
    }

    /**
     * @test
     */
    public function testDeleteEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $this->json('DELETE', '/api/v1/emailTmplates/'.$emailTmplate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/emailTmplates/'.$emailTmplate->id);

        $this->assertResponseStatus(404);
    }
}

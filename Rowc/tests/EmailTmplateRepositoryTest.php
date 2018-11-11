<?php

use App\Models\EmailTmplate;
use App\Repositories\EmailTmplateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailTmplateRepositoryTest extends TestCase
{
    use MakeEmailTmplateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmailTmplateRepository
     */
    protected $emailTmplateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->emailTmplateRepo = App::make(EmailTmplateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmailTmplate()
    {
        $emailTmplate = $this->fakeEmailTmplateData();
        $createdEmailTmplate = $this->emailTmplateRepo->create($emailTmplate);
        $createdEmailTmplate = $createdEmailTmplate->toArray();
        $this->assertArrayHasKey('id', $createdEmailTmplate);
        $this->assertNotNull($createdEmailTmplate['id'], 'Created EmailTmplate must have id specified');
        $this->assertNotNull(EmailTmplate::find($createdEmailTmplate['id']), 'EmailTmplate with given id must be in DB');
        $this->assertModelData($emailTmplate, $createdEmailTmplate);
    }

    /**
     * @test read
     */
    public function testReadEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $dbEmailTmplate = $this->emailTmplateRepo->find($emailTmplate->id);
        $dbEmailTmplate = $dbEmailTmplate->toArray();
        $this->assertModelData($emailTmplate->toArray(), $dbEmailTmplate);
    }

    /**
     * @test update
     */
    public function testUpdateEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $fakeEmailTmplate = $this->fakeEmailTmplateData();
        $updatedEmailTmplate = $this->emailTmplateRepo->update($fakeEmailTmplate, $emailTmplate->id);
        $this->assertModelData($fakeEmailTmplate, $updatedEmailTmplate->toArray());
        $dbEmailTmplate = $this->emailTmplateRepo->find($emailTmplate->id);
        $this->assertModelData($fakeEmailTmplate, $dbEmailTmplate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmailTmplate()
    {
        $emailTmplate = $this->makeEmailTmplate();
        $resp = $this->emailTmplateRepo->delete($emailTmplate->id);
        $this->assertTrue($resp);
        $this->assertNull(EmailTmplate::find($emailTmplate->id), 'EmailTmplate should not exist in DB');
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\EmailTmplate;
use App\Repositories\EmailTmplateRepository;

trait MakeEmailTmplateTrait
{
    /**
     * Create fake instance of EmailTmplate and save it in database
     *
     * @param array $emailTmplateFields
     * @return EmailTmplate
     */
    public function makeEmailTmplate($emailTmplateFields = [])
    {
        /** @var EmailTmplateRepository $emailTmplateRepo */
        $emailTmplateRepo = App::make(EmailTmplateRepository::class);
        $theme = $this->fakeEmailTmplateData($emailTmplateFields);
        return $emailTmplateRepo->create($theme);
    }

    /**
     * Get fake instance of EmailTmplate
     *
     * @param array $emailTmplateFields
     * @return EmailTmplate
     */
    public function fakeEmailTmplate($emailTmplateFields = [])
    {
        return new EmailTmplate($this->fakeEmailTmplateData($emailTmplateFields));
    }

    /**
     * Get fake data of EmailTmplate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmailTmplateData($emailTmplateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $emailTmplateFields);
    }
}

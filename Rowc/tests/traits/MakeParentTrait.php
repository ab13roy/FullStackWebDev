<?php

use Faker\Factory as Faker;
use App\Models\Parent;
use App\Repositories\ParentRepository;

trait MakeParentTrait
{
    /**
     * Create fake instance of Parent and save it in database
     *
     * @param array $parentFields
     * @return Parent
     */
    public function makeParent($parentFields = [])
    {
        /** @var ParentRepository $parentRepo */
        $parentRepo = App::make(ParentRepository::class);
        $theme = $this->fakeParentData($parentFields);
        return $parentRepo->create($theme);
    }

    /**
     * Get fake instance of Parent
     *
     * @param array $parentFields
     * @return Parent
     */
    public function fakeParent($parentFields = [])
    {
        return new Parent($this->fakeParentData($parentFields));
    }

    /**
     * Get fake data of Parent
     *
     * @param array $postFields
     * @return array
     */
    public function fakeParentData($parentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'email' => $fake->word,
            'first_name' => $fake->word,
            'last_name' => $fake->word,
            'student_identity' => $fake->word,
            'phone' => $fake->word,
            'gender' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $parentFields);
    }
}

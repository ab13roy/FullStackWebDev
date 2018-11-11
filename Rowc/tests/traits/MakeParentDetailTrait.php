<?php

use Faker\Factory as Faker;
use App\Models\ParentDetail;
use App\Repositories\ParentDetailRepository;

trait MakeParentDetailTrait
{
    /**
     * Create fake instance of ParentDetail and save it in database
     *
     * @param array $parentDetailFields
     * @return ParentDetail
     */
    public function makeParentDetail($parentDetailFields = [])
    {
        /** @var ParentDetailRepository $parentDetailRepo */
        $parentDetailRepo = App::make(ParentDetailRepository::class);
        $theme = $this->fakeParentDetailData($parentDetailFields);
        return $parentDetailRepo->create($theme);
    }

    /**
     * Get fake instance of ParentDetail
     *
     * @param array $parentDetailFields
     * @return ParentDetail
     */
    public function fakeParentDetail($parentDetailFields = [])
    {
        return new ParentDetail($this->fakeParentDetailData($parentDetailFields));
    }

    /**
     * Get fake data of ParentDetail
     *
     * @param array $postFields
     * @return array
     */
    public function fakeParentDetailData($parentDetailFields = [])
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
        ], $parentDetailFields);
    }
}

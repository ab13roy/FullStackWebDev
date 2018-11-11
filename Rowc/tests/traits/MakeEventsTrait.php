<?php

use Faker\Factory as Faker;
use App\Models\Events;
use App\Repositories\EventsRepository;

trait MakeEventsTrait
{
    /**
     * Create fake instance of Events and save it in database
     *
     * @param array $eventsFields
     * @return Events
     */
    public function makeEvents($eventsFields = [])
    {
        /** @var EventsRepository $eventsRepo */
        $eventsRepo = App::make(EventsRepository::class);
        $theme = $this->fakeEventsData($eventsFields);
        return $eventsRepo->create($theme);
    }

    /**
     * Get fake instance of Events
     *
     * @param array $eventsFields
     * @return Events
     */
    public function fakeEvents($eventsFields = [])
    {
        return new Events($this->fakeEventsData($eventsFields));
    }

    /**
     * Get fake data of Events
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEventsData($eventsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'user_type' => $fake->word,
            'event_start' => $fake->word,
            'event_end' => $fake->word,
            'event_join_date' => $fake->word,
            'number_of_people' => $fake->word,
            'status' => $fake->randomDigitNotNull,
            'city_name' => $fake->word,
            'age_range' => $fake->word,
            'pay_percentage' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $eventsFields);
    }
}

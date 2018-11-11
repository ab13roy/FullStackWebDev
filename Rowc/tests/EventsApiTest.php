<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventsApiTest extends TestCase
{
    use MakeEventsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEvents()
    {
        $events = $this->fakeEventsData();
        $this->json('POST', '/api/v1/events', $events);

        $this->assertApiResponse($events);
    }

    /**
     * @test
     */
    public function testReadEvents()
    {
        $events = $this->makeEvents();
        $this->json('GET', '/api/v1/events/'.$events->id);

        $this->assertApiResponse($events->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEvents()
    {
        $events = $this->makeEvents();
        $editedEvents = $this->fakeEventsData();

        $this->json('PUT', '/api/v1/events/'.$events->id, $editedEvents);

        $this->assertApiResponse($editedEvents);
    }

    /**
     * @test
     */
    public function testDeleteEvents()
    {
        $events = $this->makeEvents();
        $this->json('DELETE', '/api/v1/events/'.$events->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/events/'.$events->id);

        $this->assertResponseStatus(404);
    }
}

<?php

use App\Models\Events;
use App\Repositories\EventsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventsRepositoryTest extends TestCase
{
    use MakeEventsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EventsRepository
     */
    protected $eventsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->eventsRepo = App::make(EventsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEvents()
    {
        $events = $this->fakeEventsData();
        $createdEvents = $this->eventsRepo->create($events);
        $createdEvents = $createdEvents->toArray();
        $this->assertArrayHasKey('id', $createdEvents);
        $this->assertNotNull($createdEvents['id'], 'Created Events must have id specified');
        $this->assertNotNull(Events::find($createdEvents['id']), 'Events with given id must be in DB');
        $this->assertModelData($events, $createdEvents);
    }

    /**
     * @test read
     */
    public function testReadEvents()
    {
        $events = $this->makeEvents();
        $dbEvents = $this->eventsRepo->find($events->id);
        $dbEvents = $dbEvents->toArray();
        $this->assertModelData($events->toArray(), $dbEvents);
    }

    /**
     * @test update
     */
    public function testUpdateEvents()
    {
        $events = $this->makeEvents();
        $fakeEvents = $this->fakeEventsData();
        $updatedEvents = $this->eventsRepo->update($fakeEvents, $events->id);
        $this->assertModelData($fakeEvents, $updatedEvents->toArray());
        $dbEvents = $this->eventsRepo->find($events->id);
        $this->assertModelData($fakeEvents, $dbEvents->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEvents()
    {
        $events = $this->makeEvents();
        $resp = $this->eventsRepo->delete($events->id);
        $this->assertTrue($resp);
        $this->assertNull(Events::find($events->id), 'Events should not exist in DB');
    }
}

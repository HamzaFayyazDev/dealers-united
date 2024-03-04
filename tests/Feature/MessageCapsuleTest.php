<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\{User, MessageCapsule};

class MessageCapsuleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testRetrieveSingleMessageCapsule()
    {
        $messageCapsule = MessageCapsule::factory()->recycle($this->user)->opened()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/users/{$this->user->id}/message-capsules/{$messageCapsule->id}");

        $response->assertStatus(Response::HTTP_OK)->assertJsonFragment(['id' => $messageCapsule->id]);
    }

    public function testCreateMessageCapsule()
    {
        $messageCapsuleData = MessageCapsule::factory()->withNoteAndScheduledOpeningTime();

        $response = $this->actingAs($this->user)->postJson("/api/v1/users/{$this->user->id}/message-capsules", $messageCapsuleData);

        $response->assertStatus(Response::HTTP_CREATED)->assertJsonFragment($messageCapsuleData);

        $this->assertDatabaseHas('message_capsules', $messageCapsuleData);
    }

    public function testOpenMessageCapsule()
    {
        $messageCapsule = MessageCapsule::factory()->recycle($this->user)->scheduledTimePassed()->create();

        $response = $this->actingAs($this->user)->putJson("/api/v1/users/{$this->user->id}/message-capsules/{$messageCapsule->id}/open");

        $response->assertStatus(Response::HTTP_OK)->assertJsonFragment(['is_opened' => true]);

        $this->assertTrue(boolval(MessageCapsule::find($messageCapsule->id)->is_opened));
    }
}

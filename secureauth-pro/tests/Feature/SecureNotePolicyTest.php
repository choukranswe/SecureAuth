<?php

namespace Tests\Feature;

use App\Models\SecureNote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecureNotePolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_create_update_and_delete_secure_note(): void
    {
        $user = User::factory()->create();

        $createResponse = $this->actingAsOtpVerified($user)->post(route('secure-notes.store'), [
            'title' => 'Launch keys',
            'content' => 'Rotate credentials after demo.',
        ]);

        $note = SecureNote::firstOrFail();

        $createResponse->assertRedirect(route('secure-notes.show', $note));

        $this->actingAsOtpVerified($user)
            ->patch(route('secure-notes.update', $note), [
                'title' => 'Launch keys updated',
                'content' => 'Rotation completed.',
            ])
            ->assertRedirect(route('secure-notes.show', $note));

        $this->assertSame('Launch keys updated', $note->refresh()->title);

        $this->actingAsOtpVerified($user)
            ->delete(route('secure-notes.destroy', $note))
            ->assertRedirect(route('secure-notes.index'));

        $this->assertDatabaseMissing('secure_notes', [
            'id' => $note->id,
        ]);
    }

    public function test_non_owner_cannot_access_another_users_secure_note(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $note = SecureNote::create([
            'user_id' => $owner->id,
            'title' => 'Private note',
            'content' => 'Only the owner can read this.',
        ]);

        $this->actingAsOtpVerified($otherUser)
            ->get(route('secure-notes.show', $note))
            ->assertForbidden();

        $this->actingAsOtpVerified($otherUser)
            ->patch(route('secure-notes.update', $note), [
                'title' => 'Attempted update',
                'content' => 'Blocked by policy.',
            ])
            ->assertForbidden();

        $this->actingAsOtpVerified($otherUser)
            ->delete(route('secure-notes.destroy', $note))
            ->assertForbidden();
    }
}

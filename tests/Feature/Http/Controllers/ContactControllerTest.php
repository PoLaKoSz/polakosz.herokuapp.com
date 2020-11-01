<?php

namespace Tests\Feature\Http\Controllers;

use App\Contact;
use App\User;
use App\Services\MovieService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreThrowExceptionWithoutRequiredInputs()
    {
        $response = $this->post('/contact');

        $response->assertSessionHasErrors([
            'name',
            'email',
            'message',
        ]);
    }

    public function testStoreRedirectAfterSuccessfullOperation()
    {
        $response = $this->post('/contact', [
                'name'    => 'Tom PoLáKoSz',
                'email'   => 'polakosz@freemail.hu',
                'message' => 'Hi! How are You?',
            ]);

        $response->assertRedirect('/');
    }

    public function testDestroyRedirectWhenUserNotAuthenticated()
    {
        $response = $this->delete('/contact/1');

        $response->assertRedirect('/hu');
    }

    public function testDestroyThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->delete('/contact/1');

        $response->assertStatus(404);
    }

    public function testDestroyDeleteContactWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create();
        $contact->save();

        $response = $this->actingAs($user)
            ->delete("/contact/{$contact->id}");

        $response->assertStatus(200);
        $this->assertEquals(0, Contact::count());
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Contact;
use App\User;
use App\Http\Middleware\MinifySourceCode;
use App\Services\MovieService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    public function testStoreThrowExceptionWithoutRequiredInputs()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->post('/contact');

        $response->assertSessionHasErrors([
            'name',
            'email',
            'message',
        ]);
    }
    
    public function testStoreRedirectAfterSuccessfullOperation()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->post('/contact', [
                'name'    => 'Tom PoLáKoSz',
                'email'   => 'polakosz@freemail.hu',
                'message' => 'Hi! How are You?',
            ]);

        $response->assertRedirect('/');
    }

    public function testDestroyRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->delete('/contact/1');

        $response->assertRedirect();
    }
    
    public function testDestroyThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->delete('/contact/' . 999999999);

        $response->assertStatus(404);
    }

    /**
     * @depends testStoreRedirectAfterSuccessfullOperation
     */
    public function testDestroyDeleteContactWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();
        $contact = $this->lastAddedContact();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->delete('/contact/' . $contact->id);

        $response->assertStatus(200);
        $this->assertNotEquals($contact->id, $this->lastAddedContact(), 'Contact which created by a test suite didn\'t get deleted');
    }

    private function lastAddedContact() : ?Contact
    {
        return Contact::latest()->first();
    }
}

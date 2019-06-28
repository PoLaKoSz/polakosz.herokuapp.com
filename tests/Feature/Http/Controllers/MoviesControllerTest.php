<?php

namespace Tests\Feature\Http\Controllers;

use App\Movie;
use App\User;
use App\Http\Middleware\MinifySourceCode;
use App\Services\MovieService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    public function testIndexReturnCorrectView()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/movies');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.movies.index');
    }

    public function testIndexReturnCorrectData()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/movies');

        $response
            ->assertStatus(200)
            ->assertViewHas('movies');
    }

    public function testJsonmoduleNextidIsIncreased()
    {
        $response = $this->json('GET', 'api/movies', ['id' => 7]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['next-id' => 13]);
    }

    public function testCreateRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/movies/new');

        $response->assertRedirect();
    }
    
    public function testCreateReturnCorrectViewWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->get('/movies/new');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.movies.create');
    }

    public function testStoreRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->post('/movies');

        $response->assertRedirect();
    }

    public function testStoreWithoutRequiredInputsWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->post('/movies');

        $response->assertSessionHasErrors([
            'title_hu',
            'title_en',
            'imdb_id',
            'cover_image',
            'rating'
        ]);
    }
    
    public function testStoreReturnCorrectViewWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->post('/movies', [
                'title_hu'   => 'Jay és Néma Bob visszavág',
                'comment_hu' => 'Magyar komment',
                'title_en'   => 'Jay and Silent Bob Reboot',
                'comment_en' => 'English comment',
                'mafab_id'   => 'jay-es-nema-bob-visszavag-11027',
                'imdb_id'    => '6521876',
                'cover_image'=> 'jay-and-silent-bob-reboot.jpg',
                'rating'     => 6,
            ]);

        $response->assertRedirect('hu/movies/new');
    }

    public function testEditRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/movies/10/edit');

        $response->assertRedirect();
    }

    public function testEditRedirectNextIdWhenParameterMovieIdDoesNotExists()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->get('/movies/0/edit');

        $response->assertRedirect('hu/movies/1/edit');
    }

    public function testUpdateRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->patch('/movies/1');

        $response->assertRedirect();
    }

    public function testUpdateWithoutRequiredInputsWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->patch('/movies/1');

        $response->assertSessionHasErrors([
            'title_hu',
            'title_en',
            'imdb_id',
            'cover_image',
            'rating'
        ]);
    }
    
    public function testUpdateThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->patch('/movies/' . 999999999, [
                'title_hu' => 'Magyar cím',
                'title_en' => 'English title',
                'mafab_id' => 'Mafab.hu ID',
                'imdb_id' => -1,
                'cover_image' => 'just a string',
                'rating' => 1,
            ]);

        $response->assertStatus(404);
    }

    public function testUpdateRedirectAfterSuccessfullOperation()
    {
        $user = factory(User::class)->create();

        $movieService = new MovieService();
        $movie = $movieService->find(1);

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->patch('/movies/1', [
                'title_hu' => $movie->hungarian->title,
                'title_en' => $movie->english->title,
                'mafab_id' => $movie->hungarian->mafab->id,
                'imdb_id' => $movie->english->id,
                'cover_image' => $movie->cover_image,
                'rating' => $movie->rating,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('hu/movies');
    }

    public function testDestroyRedirectWhenUserNotAuthenticated()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->delete('/movies/1');

        $response->assertRedirect();
    }
    
    public function testDestroyThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->delete('/movies/' . 999999999);

        $response->assertStatus(404);
    }

    /**
     * @depends testStoreReturnCorrectViewWhenUserAuthenticated
     */
    public function testDestroyDeleteMovieWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();
        $movie = $this->lastAddedMovie();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->delete('/movies/' . $movie->id);

        $response->assertStatus(200);
        $this->assertNotEquals($movie->id, $this->lastAddedMovie(), 'Movie which created by a test suite didn\'t get deleted');
    }

    private function lastAddedMovie() : Movie
    {
        $movieService = new MovieService();

        return $movieService->getWithDetails(1)[0];
    }
}

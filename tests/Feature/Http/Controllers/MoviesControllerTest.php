<?php

namespace Tests\Feature\Http\Controllers;

use App\Movie;
use App\Services\MovieService;
use App\User;
use LaravelLocalization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnCorrectView()
    {
        $response = $this->get('/movies');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.movies.index');
    }

    public function testIndexReturnCorrectData()
    {
        $response = $this->get('/movies');

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
        $response = $this->get('/movies/new');

        $response->assertRedirect();
    }

    public function testCreateReturnCorrectViewWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/movies/new');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.movies.create');
    }

    public function testStoreRedirectWhenUserNotAuthenticated()
    {
        $response = $this->post('/movies');

        $response->assertRedirect();
    }

    public function testStoreWithoutRequiredInputsWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/movies');

        $response->assertSessionHasErrors([
            'title_en',
            'imdb_id',
            'cover_image',
            'rating'
        ]);
    }

    public function testStoreReturnCorrectViewWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
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

    public function testStoreSaveMovieWhenTheDateIsInEnglishFormat()
    {
        $user = factory(User::class)->create();
        LaravelLocalization::setLocale('en');

        $response = $this->actingAs($user)
            ->post('/movies', [
                'title_hu'   => 'Jay és Néma Bob visszavág',
                'comment_hu' => 'Magyar komment',
                'title_en'   => 'Jay and Silent Bob Reboot',
                'comment_en' => 'English comment',
                'mafab_id'   => 'jay-es-nema-bob-visszavag-11027',
                'imdb_id'    => '6521876',
                'date'       => (new \DateTime)->format(trans('movies.date_php_format')),
                'cover_image'=> 'jay-and-silent-bob-reboot.jpg',
                'rating'     => 6,
            ]);

        $response->assertRedirect('en/movies/new');
    }

    public function testStoreSaveMovieWhenTheDateIsInHungarianFormat()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/movies', [
                'title_hu'   => 'Jay és Néma Bob visszavág',
                'comment_hu' => 'Magyar komment',
                'title_en'   => 'Jay and Silent Bob Reboot',
                'comment_en' => 'English comment',
                'mafab_id'   => 'jay-es-nema-bob-visszavag-11027',
                'imdb_id'    => '6521876',
                'date'       => (new \DateTime)->format(trans('movies.date_php_format')),
                'cover_image'=> 'jay-and-silent-bob-reboot.jpg',
                'rating'     => 6,
            ]);

        $response->assertRedirect('hu/movies/new');
    }

    public function testEditRedirectWhenUserNotAuthenticated()
    {
        $response = $this->get('/movies/10/edit');

        $response->assertRedirect();
    }

    public function testEditReturnCorrectViewWhenAuthenticated()
    {
        $user = factory(User::class)->create();
        $movie = factory(Movie::class)->create();
        $movie->save();

        $response = $this->actingAs($user)
            ->get("/movies/{$movie->id}/edit");

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.movies.edit');
    }

    public function testEditRedirectNextIdWhenParameterMovieIdDoesNotExists()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/movies/0/edit');

        $response->assertRedirect('hu/movies/1/edit');
    }

    public function testUpdateRedirectWhenUserNotAuthenticated()
    {
        $response = $this->patch('/movies/1');

        $response->assertRedirect();
    }

    public function testUpdateWithoutRequiredInputsWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->patch('/movies/1');

        $response->assertSessionHasErrors([
            'title_en',
            'imdb_id',
            'cover_image',
            'rating'
        ]);
    }

    public function testUpdateThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
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
        $movie = factory(Movie::class)->create();
        $movie->save();

        $response = $this->actingAs($user)
            ->patch("/movies/{$movie->id}", [
                'title_en' => $movie->en_title,
                'imdb_id' => $movie->imdb_id,
                'title_hu' => $movie->hu_title,
                'mafab_id' => $movie->mafab_id,
                'date' => (new \DateTime($movie->date))->format(trans('movies.date_php_format')),
                'cover_image' => $movie->cover_image,
                'rating' => $movie->rating,
            ]);

        $response->assertRedirect('hu/movies');
    }

    public function testDestroyRedirectWhenUserNotAuthenticated()
    {
        $response = $this->delete('/movies/1');

        $response->assertRedirect('/hu');
    }

    public function testDestroyThrow404WhenUserPassNotExistingId()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->delete('/movies/1');

        $response->assertStatus(404);
    }

    public function testDestroyDeleteMovieWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();
        $movie = factory(Movie::class)->create();
        $movie->save();

        $response = $this->actingAs($user)
            ->delete("/movies/{$movie->id}");

        $response->assertStatus(200);
        $this->assertEquals(0, Movie::count());
    }
}

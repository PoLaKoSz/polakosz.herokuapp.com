<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieSearchControllerTest extends TestCase
{
    use RefreshDatabase;

    private $query = 'A kém, aki dobott engem';

    public function testMafabResponseReturnNecessaryProperties()
    {
        $response = $this->json('GET', 'api/movies/search/mafab', ['movie_name' => $this->query]);

        $response->assertStatus(200);

        $response = (array) $response->getData();
        $this->assertGreaterThan(0, count($response));

        $movie = $response[0];

        $this->propertyCheckOn($movie);
    }

    public function testImdbResponseReturnNecessaryProperties()
    {
        $response = $this->json('GET', 'api/movies/search/imdb', ['movie_name' => $this->query]);

        $response->assertStatus(200);

        $response = (array) $response->getData();
        $this->assertGreaterThan(0, count($response));

        $movie = $response[0];

        $this->propertyCheckOn($movie);
    }

    private function propertyCheckOn(object $movie) : void
    {
        $this->assertObjectHasAttribute('id', $movie);
        $this->assertObjectHasAttribute('url', $movie);
        $this->assertObjectHasAttribute('name', $movie);
        $this->assertObjectHasAttribute('year', $movie);
        $this->assertObjectHasAttribute('image', $movie);
    }
}

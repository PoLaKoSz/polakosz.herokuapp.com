<?php

namespace Tests\Unit\Http\Controllers;

use App\User;
use App\Http\Controllers\MoviesController;
use App\Services\MovieService;
use App\Services\MovieServiceInterface;
use Illuminate\View\View;
use Tests\TestCase;
use Tests\Unit\Services\StaticMovieService;

class MoviesControllerTest extends TestCase
{
    private static $moviesController;
    private static $fullyDetailedMovieID;

    public static function setUpBeforeClass()
    {
        $movieService = new StaticMovieService();

        self::$moviesController = new moviesController($movieService);

        self::$fullyDetailedMovieID = 1113;
    }

    public function testEditReturnCorrectViewWhenIdValid()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = self::$moviesController->edit(99000);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('pages.movies.edit', $response->name());
    }

    public function testEditReturnDataWhenIdValid()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = self::$moviesController->edit(99000);

        $actualMovie = $response->getData()['data'];
        $this->assertEquals(99000, $actualMovie->id);
        $this->assertEquals(6, $actualMovie->rating);
        $this->assertEquals('jay-and-silent-bob-reboot.jpg', $actualMovie->cover_image);
        $this->assertEquals('Jay és Néma Bob visszavág', $actualMovie->hu->title);
        $this->assertEquals('Füvet szívsz ... :)', $actualMovie->hu->comment);
        $this->assertEquals('jay-es-nema-bob-visszavag-11027', $actualMovie->hu->mafab->id);
        $this->assertEquals('Jay and Silent Bob Reboot', $actualMovie->en->title);
        $this->assertEquals('No comment :D', $actualMovie->en->comment);
        $this->assertEquals(6521876, $actualMovie->en->imdb->id);
    }

    public function testEditFillEmptyHungarianDetailsIfNotInDb()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = self::$moviesController->edit(99000 + 2);
        
        $actualMovie = $response->getData()['data'];
        $this->assertEquals(99000 + 2, $actualMovie->id);
        $this->assertEquals(6, $actualMovie->rating);
        $this->assertEquals('the-wave.jpg', $actualMovie->cover_image);
        $this->assertEquals('', $actualMovie->hu->title);
        $this->assertEquals('', $actualMovie->hu->comment);
        $this->assertEquals('', $actualMovie->hu->mafab->id);
        $this->assertEquals('The Wave', $actualMovie->en->title);
        $this->assertEquals('Interesting', $actualMovie->en->comment);
        $this->assertEquals(1063669, $actualMovie->en->imdb->id);
    }
}

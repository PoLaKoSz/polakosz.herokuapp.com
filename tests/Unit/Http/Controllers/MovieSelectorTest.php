<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\MovieSelector;
use Tests\Unit\Services\StaticMovieService;
use Tests\TestCase;

class MovieSelectorTest extends TestCase
{
    private static $selector;

    public static function setUpBeforeClass()
    {
        $movieService = new StaticMovieService();

        $dummyStartIndex = 0;
        $dummyResultCount = 0;

        self::$selector = new MovieSelector($movieService, $dummyStartIndex, $dummyResultCount);
    }

    public function testGetForHungarianUserWhenMovieHasMafabDetails()
    {
        $actual = self::$selector->get('hu');

        $movie = $actual[0];
        $this->assertEquals('https://mafab.hu/movies/jay-es-nema-bob-visszavag-11027.html', $movie->url);
        $this->assertEquals('Jay és Néma Bob visszavág', $movie->name);
        $this->assertEquals(6, $movie->rating);
        $this->assertEquals('Füvet szívsz ... :)', $movie->comment);
        $this->assertEquals('jay-and-silent-bob-reboot.jpg', $movie->image);
    }

    public function testGetForHungarianUserWhenMovieHasNotMafabDetails()
    {
        $actual = self::$selector->get('hu');

        $movie = $actual[1];
        $this->assertEquals('https://imdb.com/title/tt1063669', $movie->url);
        $this->assertEquals('The Wave', $movie->name);
        $this->assertEquals(6, $movie->rating);
        $this->assertEquals('Interesting', $movie->comment);
        $this->assertEquals('the-wave.jpg', $movie->image);
    }

    public function testGetForEnglishUserWhenWhenOnlyIMDbDetails()
    {
        $actual = self::$selector->get('en');

        $movie = $actual[1];
        $this->assertEquals('https://imdb.com/title/tt1063669', $movie->url);
        $this->assertEquals('The Wave', $movie->name);
        $this->assertEquals(6, $movie->rating);
        $this->assertEquals('Interesting', $movie->comment);
        $this->assertEquals('the-wave.jpg', $movie->image);
    }

    public function testGetThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        self::$selector->get('de');
    }
}

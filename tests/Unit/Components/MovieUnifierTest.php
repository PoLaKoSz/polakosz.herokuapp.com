<?php

namespace Tests\Unit\Components;

use App\Components\MovieUnifier;
use Tests\TestCase;

class MovieUnifierTest extends TestCase
{
    public function testFromSearch()
    {
        $id = 10;
        $url = 'https://polakosz.hu/';
        $title = 'The Mother';
        $year = 2019;
        $coverImage = 'the-mother.png';

        $actual = MovieUnifier::fromSearch($id, $url, $title, $year, $coverImage);

        $this->assertEquals($id, $actual->id);
        $this->assertEquals($url, $actual->url);
        $this->assertEquals($title, $actual->name);
        $this->assertEquals($year, $actual->year);
        $this->assertEquals($coverImage, $actual->image);
    }

    public function testFromDb()
    {
        $url = 'https://polakosz.hu/';
        $title = 'The Mother';
        $rating = 6;
        $comment = 'Weird';
        $coverImage = 'the-mother.jpg';

        $actual = MovieUnifier::fromDB($url, $title, $rating, $comment, $coverImage);

        $this->assertEquals($url, $actual->url);
        $this->assertEquals($title, $actual->name);
        $this->assertEquals($rating, $actual->rating);
        $this->assertEquals($comment, $actual->comment);
        $this->assertEquals($coverImage, $actual->image);
    }
}

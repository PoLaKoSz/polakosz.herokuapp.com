<?php

namespace App\Components;

/**
 * This class responsible to convert a movie object from an unknow
 * source to make the property binding possible from the Views.
 */
class MovieUnifier
{
    /**
     * Generate a unified Movie object coming from some search
     *
     * @return  Object
     */
    public static function fromSearch($id, string $url, string $title, int $year, string $coverImage) : object
    {
        return (object) [
            'id'      => $id,
            'url'     => $url,
            'name'    => $title,
            'year'    => $year,
            'image'   => $coverImage
        ];
    }

    /**
     * Generate a unified Movie object coming from DB
     *
     * @return  Object
     */
    public static function fromDB(string $url, string $title, int $rating, ?string $comment, string $coverImage) : object
    {
        return (object) [
            'url'     => $url,
            'name'    => $title,
            'rating'  => $rating,
            'comment' => $comment,
            'image'   => $coverImage
        ];
    }
}

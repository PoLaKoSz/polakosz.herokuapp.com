<?php

namespace App\Components;

/**
 * This class responsible to convert a movie object from an unknow
 * source to make the property binding possible from the Views.
 */
class MovieUnifier
{
    /**
     * Generate a unified Movie object
     * 
     * @return  Object
     */
    public static function get($id, string $url, string $title, int $rating, int $year, $comment, string $coverImage) : object
    {
        return (object) [
            'id'      => $id,
            'url'     => $url,
            'name'    => $title,
            'rating'  => $rating,
            'year'    => $year,
            'comment' => $comment,
            'image'   => $coverImage
        ];
    }
}

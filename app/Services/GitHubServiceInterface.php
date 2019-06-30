<?php

namespace App\Services;

interface GitHubServiceInterface
{
    /**
     * List all public repositories for the specified (PoLáKoSz) user.
     *
     * @return array
     */
    public function get() : array;
}

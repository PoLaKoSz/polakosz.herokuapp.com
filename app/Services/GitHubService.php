<?php

namespace App\Services;

use App\Services\GitHubServiceInterface;
use Github\Client as GitHub;

class GitHubService implements GitHubServiceInterface
{
    /**
     * List all public repositories for the specified (PoLáKoSz) user.
     *
     * @return array
     */
    public function get() : array
    {
        $type = 'public';
        $sort = 'pushed';
        $direction = 'desc';
        $visibility = 'public';
        $affiliation = 'owner,collaborator';

        return (new GitHub())->api('user')->repositories('PoLaKoSz', $type, $sort, $direction, $visibility, $affiliation);
    }
}

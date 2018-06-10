<?php

namespace App\Http\Controllers;

use GitHub;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function module() {
        $type = 'public';
        $sort = 'pushed';
        $direction = 'desc';
        $visibility = 'public';
        $affiliation = 'owner,collaborator';
        
        $myRepositories = GitHub::users()->repositories('PoLaKoSz', $type, $sort, $direction, $visibility, $affiliation);

        $myRepositories = $this->OnlySixRepository($myRepositories);

        return $myRepositories;
    }

    /**
     * Return the first 5 item from the given array
     * 
     * @param  Array    $repositoryArray
     * 
     * @return Array
     */
    private function OnlySixRepository(array $repositoryArray) {
        return array_slice($repositoryArray, 0, 6);
    }
}

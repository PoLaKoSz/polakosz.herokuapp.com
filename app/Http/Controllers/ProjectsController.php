<?php

namespace App\Http\Controllers;

use GitHub;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function module()
    {
        $type = 'public';
        $sort = 'pushed';
        $direction = 'desc';
        $visibility = 'public';
        $affiliation = 'owner,collaborator';
        
        $myRepositories = GitHub::users()->repositories('PoLaKoSz', $type, $sort, $direction, $visibility, $affiliation);

        $myRepositories = $this->OnlySixRepository($myRepositories);

        $myRepositories = $this->fixRepoLang($myRepositories);

        return $myRepositories;
    }

    /**
     * Return the first 6 item from the given array
     * 
     * @param  Array    $repositoryArray
     * 
     * @return Array
     */
    private function OnlySixRepository(array $repositoryArray) : array
    {
        return array_slice($repositoryArray, 0, 6);
    }

    /**
     * Adds repository language if doesn't have.
     * 
     * @param  Array    $repositories
     * 
     * @return Array
     */
    private function fixRepoLang(array $repositories) : array
    {
        foreach ($repositories as &$repository)
        {
            if ( !isset($repository['language']))
            {
                $repository['language'] = 'unknown';
            }
        }

        return $repositories;
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\GitHubServiceInterface;

class ProjectsController extends Controller
{
    /**
     * @var GitHubServiceInterface
     */
    private $githubService;

    public function __construct(GitHubServiceInterface $githubService)
    {
        $this->githubService = $githubService;
    }

    public function module() : array
    {
        $myRepositories = $this->githubService->get();

        $myRepositories = $this->OnlySixRepository($myRepositories);

        return $this->fixRepoLang($myRepositories);
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
        foreach ($repositories as &$repository) {
            if (!isset($repository['language'])) {
                $repository['language'] = 'unknown';
            }
        }

        return $repositories;
    }
}

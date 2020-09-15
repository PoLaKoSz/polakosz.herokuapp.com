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

    public function index() : array
    {
        $myRepositories = $this->githubService->get();

        $myRepositories = $this->OnlySixRepository($myRepositories);

        $myRepositories = $this->fixRepoLang($myRepositories);

        $myRepositories = $this->removeUnnecessaryData($myRepositories);

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
        foreach ($repositories as &$repository) {
            if (!isset($repository['language'])) {
                $repository['language'] = 'unknown';
            } else if ($repository['language'] == 'C#') {
                $repository['language'] = 'csharp';
            }
        }

        return $repositories;
    }

    private function removeUnnecessaryData(array $repositories) : array
    {
        $cleanedRepositories = [];

        foreach ($repositories as $repository) {
            $cleanedRepository = (object) [
                'name' => $repository['name'],
                'description' => $repository['description'],
                'html_url' => $repository['html_url'],
                'language' => $repository['language'],
            ];
            array_push($cleanedRepositories, $cleanedRepository);
        }

        return $cleanedRepositories;
    }
}

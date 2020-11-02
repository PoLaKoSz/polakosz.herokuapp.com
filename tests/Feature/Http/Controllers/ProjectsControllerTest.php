<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ProjectsController;
use App\Services\GitHubService;
use Tests\TestCase;

class ProjectsControllerTest extends TestCase
{
    private static $projectsController;

    public static function setUpBeforeClass() : void
    {
        $githubService = new GitHubService();

        self::$projectsController = new ProjectsController($githubService);
    }

    public function testIndexReturnNecessaryProperties()
    {
        $repositories = self::$projectsController->index();

        $repository = $repositories[0];

        $this->assertObjectHasAttribute('name', $repository);
        $this->assertObjectHasAttribute('description', $repository);
        $this->assertObjectHasAttribute('language', $repository);
        $this->assertObjectHasAttribute('html_url', $repository);
    }

    public function testIndexReturnOnly6Item()
    {
        $repositories = self::$projectsController->index();

        $this->assertCount(6, $repositories);
    }
}

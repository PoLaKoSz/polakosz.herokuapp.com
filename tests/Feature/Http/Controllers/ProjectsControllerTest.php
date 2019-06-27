<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ProjectsController;
use App\Services\GitHubService;
use Tests\TestCase;

class ProjectsControllerTest extends TestCase
{
    private static $projectsController;

    public static function setUpBeforeClass()
    {
        $githubService = new GitHubService();

        self::$projectsController = new ProjectsController($githubService);
    }

    public function testModuleRepositoryReturnNecessaryProperties()
    {
        $result = self::$projectsController->module();

        $repository = $result[0];

        $this->assertArrayHasKey('name', $repository);
        $this->assertArrayHasKey('description', $repository);
        $this->assertArrayHasKey('language', $repository);
        $this->assertArrayHasKey('html_url', $repository);
    }
}

<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\ProjectsController;
use Tests\TestCase;
use Tests\Unit\Services\FakeGitHubService;

class ProjectsControllerTest extends TestCase
{
    private static $projectsController;

    public static function setUpBeforeClass() : void
    {
        $githubService = new FakeGitHubService();

        self::$projectsController = new ProjectsController($githubService);
    }

    public function testIndexReturnOnly6Item()
    {
        $repositories = self::$projectsController->index();

        $this->assertCount(6, $repositories);
    }

    public function testIndexAddMissingRepositoryLanguageProperty()
    {
        $repositories = self::$projectsController->index();

        $repository = $repositories[0];
        $this->assertEquals('unknown', $repository->language);
    }
}

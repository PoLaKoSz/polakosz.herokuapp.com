<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\ProjectsController;
use Tests\TestCase;
use Tests\Unit\Services\FakeGitHubService;

class ProjectsControllerTest extends TestCase
{
    private static $projectsController;

    public static function setUpBeforeClass()
    {
        $githubService = new FakeGitHubService();

        self::$projectsController = new ProjectsController($githubService);
    }

    public function testModuleReturnOnly6Item()
    {
        $result = self::$projectsController->module();

        $this->assertEquals(6, count($result));
    }

    public function testModuleAddMissingRepositoryLanguageProperty()
    {
        $result = self::$projectsController->module();

        $repository = $result[0];
        $this->assertEquals('unknown', $repository['language']);
    }
}

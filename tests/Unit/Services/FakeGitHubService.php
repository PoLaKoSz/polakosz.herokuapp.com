<?php

namespace Tests\Unit\Services;

use App\Services\GitHubServiceInterface;

class FakeGitHubService implements GitHubServiceInterface
{
    /**
     * List all public repositories for the specified (PoLáKoSz) user.
     * 
     * @return array
     */
    public function get() : array
    {
        return [
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
            $this->getRepository(),
        ];
    }

    private function getRepository() : array
    {
        return [
            'name'        => '',
            'description' => '',
            'html_url'    => '',
        ];
    }
}

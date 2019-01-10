<?php

namespace App\Http\Controllers\Movies;

use App\HungarianMovie;
use App\IMDb;
use App\Mafab;
use App\Movie;
use App\Port;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UncompleteMovies extends Controller
{
    public function getOneHungarian() : Movie
    {
        return $this->getModel(new HungarianMovie(), 'movie_id', new Movie());
    }

    public function hungarianCount() : int
    {
        return $this->getCount(new HungarianMovie(), 'movie_id', new Movie());
    }

    public function getOneEnglish() : Movie
    {
        return $this->getModel(new IMDb(), 'movie_id', new Movie());
    }

    public function englishCount() : int
    {
        return $this->getCount(new IMDb(), 'movie_id', new Movie());
    }

    public function getOneMafab() : HungarianMovie
    {
        return $this->getModel(new Mafab(), 'hungarian_movie_id', new HungarianMovie());
    }

    public function mafabCount() : int
    {
        return $this->getCount(new Mafab(), 'hungarian_movie_id', new HungarianMovie());
    }

    public function getOnePort() : HungarianMovie
    {
        return $this->getModel(new Port(), 'hungarian_movie_id', new HungarianMovie());
    }

    public function portCount() : int
    {
        return $this->getCount(new Port(), 'hungarian_movie_id', new HungarianMovie());
    }


    private function getModel(Model $childTable, string $idName, Model $parentTable) : Model
    {
        return $this->getModels($childTable, $idName, $parentTable)->first();
    }

    private function getCount(Model $childTable, string $idName, Model $parentTable) : int
    {
        return count($this->getModels($childTable, $idName, $parentTable));
    }

    private function getModels(Model $childTable, string $idName, Model $parentTable) : Collection
    {
        $completedMovies = $childTable::pluck( $idName )->all();
        
        return $parentTable::whereNotIn('id', $completedMovies)->get();
    }
}

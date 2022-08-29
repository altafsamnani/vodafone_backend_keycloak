<?php

namespace App\Repository;

use App\Models\Planet;

class PlanetRepository extends BaseRepository
{

    /**
     * PlanetRepository constructor.
     *
     * @param Planet $model
     */
    public function __construct(Planet $model)
    {
        parent::__construct($model);
    }

    public function getAnswer()
    {
        $model = $this->model
            ->select('question.id', 'question.title', 'answer.title as answertitle')
            ->join('answer', 'answer.question_id', '=', 'question.id')->get();

        return $model;
    }

}

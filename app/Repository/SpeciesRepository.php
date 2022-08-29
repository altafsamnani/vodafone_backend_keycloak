<?php

namespace App\Repository;

use App\Models\Species;

class SpeciesRepository extends BaseRepository
{

    /**
     * SpeciesRepository constructor.
     *
     * @param Species $model
     */
    public function __construct(Species $model)
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

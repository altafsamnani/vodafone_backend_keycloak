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

}

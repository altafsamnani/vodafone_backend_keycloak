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

}

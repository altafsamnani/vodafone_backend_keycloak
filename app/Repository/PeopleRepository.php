<?php

namespace App\Repository;

use App\Models\Person;

class PeopleRepository extends BaseRepository
{

    /**
     * PeopleRepository constructor.
     *
     * @param Person $model
     */
    public function __construct(Person $model)
    {
        parent::__construct($model);
    }
}

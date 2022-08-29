<?php

namespace App\Transformers;

use App\Services\PeopleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

/**
 * Class PeopleTransformer.
 */
class PeopleTransformer extends TransformerAbstract
{

    /** @var PeopleService $peopleService */
    private $peopleService;

    /**
     * OfferTransformer constructor.
     *
     * @param Request $request
     */
    public function __construct()
    {
        $this->peopleService = app(PeopleService::class);
        $this->config = config('vodafone');
    }

    /**
     * @param array $results
     *
     * @return array
     */
    public function transformCollection($listPeople)
    {
        $list = [];
        foreach($listPeople as $people) {
            $planet = $people->planet;
            $peopleSpeciesList = [];
            if ($planet) {
                $peopleSpeciesList = $this->getSpecies($planet);
            }

            $list[] = [
                'name' => $people->name,
                'height' => $people->height,
                'mass' => $people->mass,
                'hair_color' => $people->hair_color,
                'skin_color' => $people->skin_color,
                'eye_color' => $people->eye_color,
                'homeworld' => $this->config['swapi']['url'].'/planets/'.$people->planet_id,
                'species' => $peopleSpeciesList
            ];
        }

        return $list;
    }

    /**
     * @param array
     *
     * @return array
     */
    public function transform($result)
    {
        return $result;
    }

    /**
     * @param Collection $planet
     *
     * @return array
     */
    private function getSpecies($planet)
    {
        $peopleSpeciesList = [];
        $speciesList = $planet->species->pluck('id');
        if (count($speciesList)) {
            foreach($speciesList as $speciesId) {
                $peopleSpeciesList[] = $this->config['swapi']['url'].'/species/'.$speciesId;
            }
        }

        return $peopleSpeciesList;
    }
}

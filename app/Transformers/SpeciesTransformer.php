<?php

namespace App\Transformers;

use App\Services\SpeciesService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

/**
 * Class SpeciesTransformer.
 */
class SpeciesTransformer extends TransformerAbstract
{

    /** @var SpeciesService $speciesService */
    private $speciesService;

    /**
     * OfferTransformer constructor.
     *
     * @param Request $request
     */
    public function __construct()
    {
        $this->speciesService = app(SpeciesService::class);
        $this->config = config('vodafone');
    }

    /**
     * @param array $results
     *
     * @return array
     */
    public function transformCollection($listSpecies)
    {
        $list = [];
        foreach($listSpecies as $species) {
            $planet = $species->planet;
            $peopleList = [];
            if ($planet) {
                $peopleList = $this->getPeople($planet);
            }

            $list[] = [
                'name' => $species->name,
                'classification' => $species->classification,
                'designation' => $species->mass,
                'average_height' => $species->hair_color,
                'skin_colors' => $species->skin_color,
                'hair_colors' => $species->hair_colors,
                'eye_colors' => $species->eye_colors,
                'average_lifespan' => $species->average_lifespan,
                'language' => $species->language,
                'eye_color' => $species->eye_color,
                'homeworld' => $this->config['swapi']['url'].'/planets/'.$species->planet_id,
                'people' => $peopleList,
                'created' => $species->created_at,
                'updated' => $species->updated_at,
                'url' => $this->config['swapi']['url'].'/species/'.$species->id
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
    private function getPeople($planet)
    {
        $peopleList = [];
        $planetPeopleList = $planet->people->pluck('id');
        if (count($planetPeopleList)) {
            foreach($planetPeopleList as $peopleId) {
                $peopleList[] = $this->config['swapi']['url'].'/people/'.$peopleId;
            }
        }

        return $peopleList;
    }
}

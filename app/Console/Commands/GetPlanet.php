<?php

namespace App\Console\Commands;

use App\Repository\PlanetRepository;
use App\Services\Contracts\PlanetServiceInterface;
use Log;
use Exception;
use App\Planet;
use Illuminate\Console\Command;

class GetPlanet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vodafone:planet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets data about planet from Star Wars and save to database';

    /**
     * The guzzle client.
     *
     * @var PlanetServiceInterface
     */
    protected $planetService;

    /**
     * The guzzle client.
     *
     * @var PlanetRepository
     */
    protected $planetRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PlanetServiceInterface $planetService, PlanetRepository $planetRepository)
    {
        $this->planetService = $planetService;
        $this->planetRepository = $planetRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $response = $this->planetService->getSwAll()['results'];
            $planetCounter = $this->savePlanet($response);
            Log::info("Saved $planetCounter planet from Star Wars");

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Save planet to database.
     *
     * @param array $planet
     *
     * @return int
     */
    private function savePlanet(array $planets): int
    {
        $existingPlanets = $this->planetRepository->all()->pluck('id')->all();
        $planetSavedCounter = 0;
        $displayTable = [];
        foreach($planets as $planet) {
            $parsedUrl = parse_url($planet['url'], PHP_URL_PATH);
            $planetPath = explode('/', $parsedUrl);
            $planet['id'] = $planetPath[3];
            if(!in_array($planet['id'], $existingPlanets)) {
                $planet['population'] = $planet['population'] === 'unknown' ? 0 : $planet['population'];
                $planet['surface_water'] = $planet['surface_water'] === 'unknown' ? 0 : $planet['surface_water'];

                $this->planetRepository->create($planet);
                $planetSavedCounter++;

                $displayTable[] = ['id' => $planet['id'], 'name' => $planet['name'], 'population' => $planet['population']];
            }
        }

        $this->table(['id', 'name', 'population'], $displayTable);

        return $planetSavedCounter;
    }
}

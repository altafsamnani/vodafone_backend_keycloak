<?php

namespace App\Console\Commands;

use App\Repository\PeopleRepository;
use App\Services\Contracts\PeopleServiceInterface;
use Log;
use Exception;
use App\People;
use Illuminate\Console\Command;

class GetPeople extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vodafone:people';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets data about people from Star Wars and save to database';

    /**
     * The guzzle client.
     *
     * @var PeopleServiceInterface
     */
    protected $peopleService;

    /**
     * The guzzle client.
     *
     * @var PeopleRepository
     */
    protected $peopleRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PeopleServiceInterface $peopleService, PeopleRepository $peopleRepository)
    {
        $this->peopleService = $peopleService;
        $this->peopleRepository = $peopleRepository;
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
            $this->callSilently('vodafone:planet');
            $response = $this->peopleService->getSwAll()['results'];
            $peopleCounter = $this->savePeople($response);
            Log::info("Saved $peopleCounter people from Star Wars");

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }


    /**
     * Save people to database.
     *
     * @param array $people
     *
     * @return int
     */
    private function savePeople(array $people): int
    {
        $peopleSavedCounter = 0;
        foreach($people as $person) {

            $parsedUrl = parse_url($person['url'], PHP_URL_PATH);
            $personPath = explode('/', $parsedUrl);
            $person['id'] = $personPath[3];

            $parsedPlanetUrl = parse_url($person['homeworld'], PHP_URL_PATH);
            $planetPath = explode('/', $parsedPlanetUrl);
            $person['planet_id'] = $planetPath[3];

            $this->peopleRepository->create($person);
            $peopleSavedCounter++;

            $displayTable[] = ['id' => $person['id']  , 'name' => $person['name'], 'birth_year' => $person['birth_year']];
        }

        $this->table(['id', 'name', 'birth_year'], $displayTable);

        return $peopleSavedCounter;
    }
}

<?php

namespace Tests\Feature;

use App\Models\Person as People;
use App\Repository\PeopleRepository;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 */
class PeopleTest extends TestCase
{
    /**
     * Config variables for the People
     *
     * @var array
     */
    private $testConfig;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->testConfig = config('vodafone');
    }

    /**
     * @dataProvider peopleProvider
     */
    public function test_PeopleSuccess($id, $name)
    {
        $this->mock(PeopleRepository::class, function (MockInterface $mock) use ($id){
            $mock->shouldReceive('create')->andReturn(new People(['id' => $id]));
        });

        $this->artisan('vodafone:people')->assertExitCode(0);
    }


    public function peopleProvider()
    {
        return [
            [1, 'Altaf Samnani'],
            [2, 'Abby Singh'],
        ];
    }
}

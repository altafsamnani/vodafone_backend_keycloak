<?php

namespace App\Services\Contracts;

/**
 * Interface PlanetServiceInterface.
 */
interface PlanetServiceInterface
{
    /**
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array;

    /**
     * @param int $id
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): mixed;
}

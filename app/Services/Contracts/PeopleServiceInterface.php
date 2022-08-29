<?php

namespace App\Services\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface PeopleServiceInterface.
 */
interface PeopleServiceInterface
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
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): array;
}

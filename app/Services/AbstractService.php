<?php

namespace App\Services;

use App\Repository\Contract\RepositoryInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractService.
 */
class AbstractService
{
    /**
     * @var string
     */
    protected $endpoint;

    /** @var Client */
    protected $guzzleClient;

    /** @var RepositoryInterface */
    private $respository;

    /** @var string */
    protected $uri = 'people';

    /**
     * AbstractService constructor.
     *
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
        $this->endpoint = config('vodafone.swapi.url');
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): array
    {
        $url = sprintf('%s/%d', $this->uri, $id);

        return $this->makeRequest('GET', $url);
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSwAll(): array
    {
        $url = sprintf('%s', $this->uri);

        return $this->makeRequest('GET', $url);
    }

    /**
     * @param string $httpVerb
     * @param string $resource
     * @param array  $args
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function makeRequest(string $httpVerb, string $resource, array $args = []): array
    {
        $uri = $this->endpoint.'/'.$resource;

        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];
        if ($args) {
            $options['body'] = json_encode($args, JSON_PRESERVE_ZERO_FRACTION);
        }

        try {
            $response = $this->guzzleClient->request($httpVerb, $uri, $options);
            $contents = json_decode($response->getBody(),true);

            return $contents;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function parseToArray(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}

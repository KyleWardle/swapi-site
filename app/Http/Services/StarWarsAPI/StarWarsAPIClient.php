<?php

namespace App\Http\Services\StarWarsAPI;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class StarWarsAPIClient
{
    public const REQUEST_POST = 'POST';
    public const REQUEST_GET = 'GET';
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $baseUri;

    public function __construct()
    {
        $this->baseUri = config('star_wars.base_uri');
    }

    /**
     * @param string $resource
     * @param int|null $resourceId
     * @param string $method
     * @return StarWarsAPIResponse
     * @throws StarWarsApiException
     */
    public function queryApi(
        string $resource,
        int $resourceId = null,
        string $method = self::REQUEST_GET
    ): StarWarsAPIResponse
    {
        $client = new Client;

        $uri = $this->baseUri . '/' . $resource;

        if ($resourceId) {
            $uri = $uri . '/' . $resourceId;
        }

        try {
            $response = $client->request($method, $uri);
        } catch (GuzzleException $e) {
            throw new StarWarsApiException($e->getMessage(), $e->getCode());
        }

        $contents = $response->getBody()->getContents();
        $decodedResponse = json_decode($contents, true);

        if ($resourceId) {
            return new StarWarsAPIResponse(1, [$decodedResponse]);
        }

        return new StarWarsAPIResponse($decodedResponse['count'], $decodedResponse['results']);
    }
}

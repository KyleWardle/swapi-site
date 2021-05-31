<?php

namespace App\Http\Services\StarWarsApi\Swapi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SwapiApiClient
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
     * @return SwapiApiResponse
     * @throws SwapiApiException
     */
    public function getResource(
        string $resource,
        int $resourceId = null,
        string $method = self::REQUEST_GET
    ): SwapiApiResponse
    {
        $client = new Client;

        $url = $this->baseUri . '/' . $resource;

        if ($resourceId) {
            $url = $url . '/' . $resourceId;
        }

        try {
            $response = $client->request($method, $url);
        } catch (GuzzleException $e) {
            throw new SwapiApiException($e->getMessage(), $e->getCode());
        }

        $contents = $response->getBody()->getContents();
        $decodedResponse = json_decode($contents, true);

        if ($resourceId) {
            return new SwapiApiResponse(1, [$decodedResponse]);
        }

        return new SwapiApiResponse($decodedResponse['count'], $decodedResponse['results']);
    }
}

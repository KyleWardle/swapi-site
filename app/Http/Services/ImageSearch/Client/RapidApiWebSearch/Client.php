<?php

namespace App\Http\Services\ImageSearch\Client\RapidApiWebSearch;

use App\Http\Services\ImageSearch\Client\ImageSearchClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Cache;

class Client implements ImageSearchClientInterface
{
    /**
     * @param string $searchString
     * @return string|null
     * @throws RapidApiWebSearchClientException
     */
    public function getImageUrl(string $searchString): ?string
    {
        $oneDayInSeconds = 60 * 60 * 24;
        $cachePrefix = 'rapid-api-image-';

        return Cache::remember($cachePrefix . $searchString, $oneDayInSeconds, function () use ($searchString) {
            $response = $this->queryApi('ImageSearchAPI', [
                'q' => $searchString,
                'pageNumber' => '1',
                'pageSize' => '10',
                'autoCorrect' => 'true'
            ]);

            if ($response['totalCount'] > 0) {
                $images = $response['value'];

                foreach ($images as $image) {
                    if ($this->checkRemoteFileExists($image['url'])) {
                        return $image['url'];
                    }
                }
            }

            return null;
        });
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     * @throws RapidApiWebSearchClientException
     */
    private function queryApi(string $url, array $params = []): array
    {
        $requestUrl = config('rapid_api_search.base_url') . '/' . $url;
        $client = new GuzzleClient;

        try {
            $response = $client->get($requestUrl, [
                RequestOptions::HEADERS => [
                    'x-rapidapi-host' => config('rapid_api_search.host'),
                    'x-rapidapi-key' => config('rapid_api_search.key')
                ],
                RequestOptions::QUERY => $params
            ]);

        } catch (GuzzleException $e) {
            throw new RapidApiWebSearchClientException($e->getMessage(), $e->getCode());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @return bool
     */
    private function checkRemoteFileExists(string $url): bool
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        if($result !== FALSE) {
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace App\Http\Services\ImageSearch;

use App\Http\Services\ImageSearch\Client\ImageSearchClientInterface;

class ImageSearchService
{
    /**
     * @var ImageSearchClientInterface
     */
    private ImageSearchClientInterface $imageSearchClient;

    /**
     * ImageSearchService constructor.
     * @param ImageSearchClientInterface $imageSearchClient
     */
    public function __construct(ImageSearchClientInterface $imageSearchClient)
    {
        $this->imageSearchClient = $imageSearchClient;
    }

    /**
     * @param string $searchTerm
     * @return string|null - Image url
     */
    public function searchForImage(string $searchTerm): ?string
    {
        return $this->imageSearchClient->getImageUrl($searchTerm);
    }
}

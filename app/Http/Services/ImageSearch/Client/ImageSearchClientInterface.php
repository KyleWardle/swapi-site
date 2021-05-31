<?php

namespace App\Http\Services\ImageSearch\Client;

interface ImageSearchClientInterface
{
    /**
     * @param string $searchString
     * @return string|null
     */
    public function getImageUrl(string $searchString): ?string;
}

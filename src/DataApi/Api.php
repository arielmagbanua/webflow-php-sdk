<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi;

use ArielMagbanua\PhpWebflowApi\BaseApi;

/**
 * The Base Data API class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi
 */
abstract class Api extends BaseApi
{
    /**
     * The Data API constructor
     *
     * @param string $accessToken The access token
     * @param string $version The API version
     */
    public function __construct(protected string $accessToken, protected string $version)
    {
        // set the whole base URL with the API version
        $this->apiBaseUrl = $this->apiBaseUrl . '/' . $this->version . '/';

        // set the headers
        $this->headers = array_merge($this->headers, [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ]);

        // call the parent constructor
        parent::__construct();
    }

    /**
     * Set the access token
     *
     * @param string $accessToken The access token
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Set the API version
     *
     * @param string $version The version
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}

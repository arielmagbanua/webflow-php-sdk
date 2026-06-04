<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Pages contract for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts
 */
abstract class Pages extends Api
{
    /**
     * The Pages constructor
     *
     * @param string $accessToken The access token
     * @param string $version The version of the API
     */
    public function __construct(string $accessToken, string $version)
    {
        parent::__construct(accessToken: $accessToken, version: $version);
    }

    /**
     * List of all pages for a site.
     *
     * @param string $siteId Unique identifier for a Site
     * @param string|null $localeId Unique identifier for a specific Locale
     * @param int|null $limit Maximum number of records to be returned (max limit: 100)
     * @param int|null $offset Offset used for pagination if the results have more than limit records
     */
    abstract public function listPages(string $siteId, ?string $localeId = null, ?int $limit = null, ?int $offset = null): ?array;
}

<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

abstract class Components extends Api
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
     * List of all components for a site.
     *
     * @param string $siteId Unique identifier for a Site
     * @param string|null $branchId Scope the operation to work on a specific branch
     * @param integer|null $limit Maximum number of records to be returned (max limit: 100)
     * @param integer|null $offset Offset used for pagination if the results have more than limit records
     */
    abstract public function listComponents(string $siteId, ?string $branchId = null, ?int $limit = null, ?int $offset = null): ?array;
}

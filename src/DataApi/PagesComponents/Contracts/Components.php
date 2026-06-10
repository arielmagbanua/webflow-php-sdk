<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Components contract for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts
 */
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

    /**
     * Get static content from a component definition.
     * This includes text nodes, image nodes, select nodes, text input nodes, submit button nodes, and nested component instances.
     * To retrieve dynamic content set by component properties, use the get component properties endpoint.
     *
     * @param string $siteId Unique identifier for a Site
     * @param string $componentId Unique identifier for a Component
     * @param string|null $localeId Unique identifier for a specific Locale
     * @param string|null $branchId Scope the operation to work on a specific branch
     * @param integer|null $limit Maximum number of records to be returned (max limit: 100)
     * @param integer|null $offset Offset used for pagination if the results have more than limit records
     */
    abstract public function getComponentContent(
        string $siteId,
        string $componentId,
        ?string $localeId = null,
        ?string $branchId = null,
        ?int $limit = null,
        ?int $offset = null
    ): ?array;
}

<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\PagesComponents;

use ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts\Components as ComponentsContract;

/**
 * The Components class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\PagesComponents
 * @todo Create a test for this class
 */
class Components extends ComponentsContract
{
    /**
     * The Pages constructor
     *
     * @param string $accessToken The access token
     */
    public function __construct(string $accessToken)
    {
        parent::__construct(accessToken: $accessToken, version: 'v2');
    }

    /**
     * List of all components for a site.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/components/list
     *
     * @param string $siteId Unique identifier for a Site
     * @param string|null $branchId Scope the operation to work on a specific branch
     * @param integer|null $limit Maximum number of records to be returned (max limit: 100)
     * @param integer|null $offset Offset used for pagination if the results have more than limit records
     */
    public function listComponents(string $siteId, ?string $branchId = null, ?int $limit = null, ?int $offset = null): ?array
    {
        $query = [];

        // add the branchId to the query if it is not null
        if ($branchId) {
            $query['branchId'] = $branchId;
        }

        // add the limit to the query if it is not null
        if ($limit) {
            $query['limit'] = $limit;
        }

        // add the offset to the query if it is not null
        if ($offset) {
            $query['offset'] = $offset;
        }

        return $this->sendRequest(
            method: 'GET',
            uri: 'sites/' . $siteId . '/components',
            query: $query,
        );
    }

    /**
     * Get static content from a component definition.
     * This includes text nodes, image nodes, select nodes, text input nodes, submit button nodes, and nested component instances.
     * To retrieve dynamic content set by component properties, use the get component properties endpoint.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/components/get-content
     *
     * @param string $siteId Unique identifier for a Site
     * @param string $componentId Unique identifier for a Component
     * @param string|null $localeId Unique identifier for a specific Locale
     * @param string|null $branchId Scope the operation to work on a specific branch
     * @param integer|null $limit Maximum number of records to be returned (max limit: 100)
     * @param integer|null $offset Offset used for pagination if the results have more than limit records
     */
    public function getComponentContent(
        string $siteId,
        string $componentId,
        ?string $localeId = null,
        ?string $branchId = null,
        ?int $limit = null,
        ?int $offset = null
    ): ?array {
        $query = [];

        // add the localeId to the query if it is not null
        if ($localeId) {
            $query['localeId'] = $localeId;
        }

        // add the branchId to the query if it is not null
        if ($branchId) {
            $query['branchId'] = $branchId;
        }

        // add the limit to the query if it is not null
        if ($limit) {
            $query['limit'] = $limit;
        }

        // add the offset to the query if it is not null
        if ($offset) {
            $query['offset'] = $offset;
        }

        return $this->sendRequest(
            method: 'GET',
            uri: 'sites/' . $siteId . '/components/' . $componentId . '/dom',
            query: $query,
        );
    }
}

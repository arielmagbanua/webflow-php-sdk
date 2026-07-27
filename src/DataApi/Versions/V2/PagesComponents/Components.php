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

    /**
     * This endpoint updates content within a component defintion for secondary locales. It supports updating up to 1000 nodes in a single request.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/components/update-content
     *
     * Example $nodes structure:
     *
     * ```php
     * $nodes = [
     *      // text node
     *      [
     *          'nodeId' => 'a245c12d-995b-55ee-5ec7-aa36a6cad623',
     *          'text' => '<h1>The Hitchhiker\'s Guide to the Galaxy</h1>',
     *      ],
     *
     *      // component instance
     *      [
     *          'nodeId' => '',
     *          'text' => '<h1>Hello world</h1>',
     *          'propertyOverrides' => [
     *              [
     *                  'propertyId' => '7dd14c08-2e96-8d3d-2b19-b5c03642a0f0',
     *                  'text' => '<div><h1>Time is an <em>illusion</em></h1></div>',
     *              ],
     *              [
     *                  'propertyId' => '7dd14c08-2e96-8d3d-2b19-b5c03642a0f1',
     *                  'text' => 'Life, the Universe and Everything',
     *              ]
     *          ],
     *      ],
     *
     *      // select
     *      [
     *          'nodeId' => 'a245c12d-995b-55ee-5ec7-aa36a6cad635',
     *          'text' => '<h1>Hello world</h1>',
     *          'choices' => [
     *              [
     *                  'value' => 'choice-1',
     *                  'text' => 'First choice'
     *              ],
     *              [
     *                  'value' => 'choice-2',
     *                  'text' => 'Second choice'
     *              ]
     *          ]
     *      ],
     *
     *      // text input
     *      [
     *          'nodeId' => 'a245c12d-995b-55ee-5ec7-aa36a6cad642',
     *          'text' => '<h1>Hello world</h1>',
     *          'placeholder' => 'Enter something here...'
     *      ],
     *
     *      // submit button
     *      [
     *          'nodeId' => 'a245c12d-995b-55ee-5ec7-aa36a6cad671',
     *          'text' => '<h1>Hello world</h1>',
     *          'value' => 'submit',
     *          'waitingText' => 'Submitting...'
     *      ],
     *
     *      // search button
     *      [
     *          'nodeId' => 'a245c12d-995b-55ee-5ec7-112233231213',
     *          'value' => 'search'
     *      ],
     * ];
     * ```
     * @param string $siteId Unique identifier for a Site
     * @param string $componentId Unique identifier for a Component
     * @param array $nodes The updated content
     * @param string|null $localeId Unique identifier for a specific Locale
     * @param string|null $branchId Scope the operation to work on a specific branch
     */
    public function updateComponentContent(
        string $siteId,
        string $componentId,
        array $nodes,
        ?string $localeId = null,
        ?string $branchId = null,
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

        return $this->sendRequest(
            method: 'POST',
            uri: 'sites/' . $siteId . '/components/' . $componentId . '/dom',
            body: [
                'nodes' => $nodes,
            ],
            query: $query,
        );
    }
}

<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Cms\CollectionItems;

use ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionItems\Contracts\StagedItems as StagedItemsContract;

/**
 * The Staged Collection class for the Webflow API.
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\CollectionItems
 * @todo create unit tests for this class
 */
class StagedItems extends StagedItemsContract
{
    /**
     * The Staged Collection constructor
     *
     * @param string $accessToken The access token
     * @param string $collectionId The collection ID
     */
    public function __construct(string $accessToken, string $collectionId)
    {
        // call the parent constructor
        parent::__construct(accessToken: $accessToken, version: 'v2', collectionId: $collectionId);
    }

    /**
     * List of all Items within a Collection.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/list-items
     *
     * @param string|null $cmsLocaleId The CMS locale ID
     * @param int|null $offset The offset
     * @param int|null $limit The limit
     * @param string|null $name The name
     * @param string|null $slug The slug
     * @param array<string, string>|null $createdOn The created on
     * @param array<string, string>|null $lastPublished The last published
     * @param array<string, string>|null $lastUpdated The last updated
     * @param string|null $sortBy The sort by
     * @param string|null $sortOrder The sort order
     */
    public function listItems(
        ?string $cmsLocaleId = null,
        ?int $offset = null,
        ?int $limit = null,
        ?string $name = null,
        ?string $slug = null,
        ?array $createdOn = null,
        ?array $lastPublished = null,
        ?array $lastUpdated = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
    ): ?array {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . '/items/' . $this->type;

        // append the arguments as query parameters
        // but only set the parameters that are not null
        $uri .= '?' . http_build_query(array_filter([
            'cmsLocaleId' => $cmsLocaleId,
            'offset' => $offset,
            'limit' => $limit,
            'name' => $name,
            'slug' => $slug,
            // TODO: Add the createdOn, lastPublished, and lastUpdated parameters
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]));

        // send the request
        return $this->sendRequest(
            method: 'GET',
            uri: $uri,
        );
    }

    /**
     * Get details of a selected Collection Item.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/get-item
     *
     * @param string $id The ID of the item
     * @param string|null $cmsLocaleId The CMS locale ID
     */
    public function getItem(string $id, ?string $cmsLocaleId = null): ?array
    {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . "/items/$id/" . $this->type;

        // append the arguments as query parameters
        // but only set the parameters that are not null
        $uri .= '?' . http_build_query(array_filter([
            'cmsLocaleId' => $cmsLocaleId,
        ]));

        // send the request
        return $this->sendRequest(
            method: 'GET',
            uri: $uri
        );
    }

    /**
     * Get an item by slug
     *
     * @param string $slug The slug of the item
     * @param string|null $cmsLocaleId The CMS locale ID
     */
    public function getItemBySlug(string $slug, ?string $cmsLocaleId = null): ?array
    {
        $response = $this->listItems(
            cmsLocaleId: $cmsLocaleId,
            limit: 1,
            slug: $slug,
        );

        if ($response === null) {
            return null;
        }

        $items = $response['items'] ?? null;
        if (!is_array($items) || $items === []) {
            return null;
        }

        return $items[0];
    }

    /**
     * Create an item or multiple items in a CMS Collection across multiple corresponding locales.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/create-items
     *
     * @param array<array<string, mixed>> $items The items to create
     * @param bool|null $skipInvalidFiles Whether to skip invalid files
     */
    public function createItems(array $items, ?bool $skipInvalidFiles = null): ?array
    {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . '/items/' . $this->type . '/bulk';

        // append the arguments as query parameters
        // but only set the parameters that are not null
        $uri .= '?' . http_build_query(array_filter([
            'skipInvalidFiles' => $skipInvalidFiles,
        ]));

        // send the request
        return $this->sendRequest(
            method: 'POST',
            uri: $uri,
            body: [
                'items' => $items,
            ],
        );
    }

    /**
     *  Update a single item or multiple items in a Collection.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/update-items
     *
     * @param array<array<string, mixed>> $items The items to update
     * @param bool|null $skipInvalidFiles Whether to skip invalid files
     */
    public function updateItems(array $items, ?bool $skipInvalidFiles = null): ?array
    {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . '/items/' . $this->type;

        // append the arguments as query parameters
        // but only set the parameters that are not null
        $uri .= '?' . http_build_query(array_filter([
            'skipInvalidFiles' => $skipInvalidFiles,
        ]));

        // send the request
        return $this->sendRequest(
            method: 'PATCH',
            uri: $uri,
            body: [
                'items' => $items,
            ],
        );
    }

    /**
     * Delete Items from a Collection.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/delete-items
     *
     * Example $items structure:
     * ```php
     * $items = [
     *      [
     *          'id' => '580e64008c9a982ac9b8b754',
     *          'cmsLocaleIds' => ['66f6e966c9e1dc700a857ca3', '66f6e966c9e1dc700a857ca4']
     *      ]
     * ]
     * ```
     * @param array<array<string, mixed>> $items The items to delete
     */
    public function deleteItems(array $items): ?array
    {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . '/items/' . $this->type;

        // send the request
        return $this->sendRequest(
            method: 'DELETE',
            uri: $uri,
            body: [
                'items' => $items,
            ],
        );
    }

    /**
     * Publish an item or multiple items.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-items/staged-items/publish-item
     *
     * Example $ids structure:
     * ```php
     * $ids = ['580e64008c9a982ac9b8b754', '580e64008c9a982ac9b8b755'];
     * ```
     * @param array<string> $ids The IDs of the items to publish
     */
    public function publishItemIds(array $ids): ?array
    {
        // create the uri for the request
        $uri = 'collections/' . $this->collectionId . '/items/publish';

        // send the request
        return $this->sendRequest(
            method: 'POST',
            uri: $uri,
            body: [
                'items' => $ids,
            ],
        );
    }
}

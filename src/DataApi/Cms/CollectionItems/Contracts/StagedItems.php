<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionItems\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionItems\Contracts\Items;

/**
 * The Staged Items contract for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionItems\Contracts
 */
abstract class StagedItems extends Items
{
    /**
     * List of all Items within a Collection.
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
    abstract public function listItems(
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
    ): ?array;

    /**
     * Get details of a selected Collection Item.
     *
     * @param string $id The ID of the staged item
     * @param string|null $cmsLocaleId The CMS locale ID
     */
    abstract public function getItem(string $id, ?string $cmsLocaleId = null): ?array;

    /**
     * Get a staged item by slug
     *
     * @param string $slug The slug of the staged item
     * @param string|null $cmsLocaleId The CMS locale ID
     */
    abstract public function getItemBySlug(string $slug, ?string $cmsLocaleId = null): ?array;

    /**
     * Create an item or multiple items in a CMS Collection across multiple corresponding locales.
     *
     * @param array<array<string, mixed>> $items The items to create
     * @param bool|null $skipInvalidFiles Whether to skip invalid files
     */
    abstract public function createItems(array $items, ?bool $skipInvalidFiles = null): ?array;

    /**
     * Update a single item or multiple items in a Collection.
     *
     * @param array<array<string, mixed>> $items The items to update
     * @param bool|null $skipInvalidFiles Whether to skip invalid files
     */
    abstract public function updateItems(array $items, ?bool $skipInvalidFiles = null): ?array;

    /**
     * Delete Items from a Collection.
     *
     * @param array<array<string, mixed>> $items The IDs of the staged items to delete
     */
    abstract public function deleteItems(array $items): ?array;

    /**
     * Publish an item or multiple items.
     *
     * @param array<string> $ids The IDs of the staged items to publish
     */
    abstract public function publishItemIds(array $ids): ?array;
}

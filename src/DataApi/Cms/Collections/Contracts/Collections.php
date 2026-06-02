<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Cms\Collections\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Collections contract for the Webflow API
 */
abstract class Collections extends Api
{
    /**
     * The Collections constructor
     *
     * @param string $accessToken The access token
     * @param string $version The version of the API
     */
    public function __construct(string $accessToken, string $version)
    {
        parent::__construct(accessToken: $accessToken, version: $version);
    }

    /**
     * List of all Collections within a Site.
     *
     * @param string $siteId Unique identifier for a Site
     */
    abstract public function listCollections(string $siteId): ?array;

    /**
     * Get the full details of a collection from its ID.
     *
     * @param string $collectionId Unique identifier for a Collection
     */
    abstract public function getCollectionDetails(string $collectionId): ?array;

    /**
     * Create a Collection for a site with collection fields.
     *
     * @param string $siteId Unique identifier for a Site
     * @param string $displayName Name of the collection. Each collection name must be distinct
     * @param string $singularName Singular name of each item.
     * @param string $slug Part of a URL that identifier
     * @param array<string, mixed> $fields An array of custom fields to add to the collection
     */
    abstract public function createCollection(string $siteId, string $displayName, string $singularName, string $slug, array $fields): ?array;

    /**
     * Delete a collection using its ID.
     *
     * @param string $collectionId Unique identifier for a Collection
     */
    abstract public function deleteCollection(string $collectionId): ?array;
}

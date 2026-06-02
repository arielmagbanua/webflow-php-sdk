<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Cms\Collections;

use ArielMagbanua\PhpWebflowApi\DataApi\Cms\Collections\Contracts\Collections as CollectionsContract;

/**
 * The Collections class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Cms\Collections
 * @todo Create a test for this class
 */
class Collections extends CollectionsContract
{
    /**
     * The Sites constructor
     *
     * @param string $accessToken The access token
     */
    public function __construct(string $accessToken)
    {
        parent::__construct(accessToken: $accessToken, version: 'v2');
    }

    /**
     * List of all Collections within a Site.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collections/list
     *
     * @param string $siteId Unique identifier for a Site
     */
    public function listCollections(string $siteId): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'sites/' . $siteId . '/collections',
        );
    }

    /**
     * Get the full details of a collection from its ID.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collections/get
     *
     * @param string $collectionId Unique identifier for a Collection
     */
    public function getCollectionDetails(string $collectionId): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'collections/' . $collectionId,
        );
    }

    /**
     * Create a Collection for a site with collection fields.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collections/create
     *
     * @param string $siteId Unique identifier for a Site
     * @param string $displayName Name of the collection. Each collection name must be distinct
     * @param string $singularName Singular name of each item.
     * @param string $slug Part of a URL that identifier
     * @param array<string, mixed> $fields An array of custom fields to add to the collection
     */
    public function createCollection(string $siteId, string $displayName, string $singularName, string $slug, array $fields): ?array
    {
        return $this->sendRequest(
            method: 'POST',
            uri: 'sites/' . $siteId . '/collections',
            body: [
                'displayName' => $displayName,
                'singularName' => $singularName,
                'slug' => $slug,
                'fields' => $fields,
            ],
        );
    }

    /**
     * Delete a collection using its ID.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collections/delete
     *
     * @param string $collectionId Unique identifier for a Collection
     */
    public function deleteCollection(string $collectionId): ?array
    {
        return $this->sendRequest(
            method: 'DELETE',
            uri: 'collections/' . $collectionId,
        );
    }
}

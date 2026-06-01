<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Cms\CollectionFields;

use ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionFields\Contracts\Fields as CollectionFields;

/**
 * The Fields class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Cms\CollectionFields
 * @todo create unit tests for this class
 */
class Fields extends CollectionFields
{
    /**
     * The Fields constructor
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
     * Create a custom field in a collection.
     *
     * Field validation is currently not available through the API.
     *
     * Bulk creation of fields is not supported with this endpoint. To add multiple fields at once, include them when you create the collection.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-fields/create
     *
     * @param string $collectionId Unique identifier for a Collection
     * @param array $field This can be static field, option field, or reference field
     */
    public function createField(string $collectionId, array $field): ?array
    {
        return $this->sendRequest('POST', "collections/{$collectionId}/fields", $field);
    }

    /**
     * Update a custom field in a collection.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-fields/update
     *
     * @param string $collectionId Unique identifier for a Collection
     * @param string $fieldId Unique identifier for a Field in a collection
     * @param array $field The updated field data
     */
    public function updateField(string $collectionId, string $fieldId, array $field): ?array
    {
        return $this->sendRequest('PATCH', "collections/{$collectionId}/fields/{$fieldId}", $field);
    }

    /**
     * Delete a custom field in a collection. This endpoint does not currently support bulk deletion.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/cms/collection-fields/delete
     * 
     * @param string $collectionId Unique identifier for a Collection
     * @param string $fieldId Unique identifier for a Field in a collection
     */
    public function deleteField(string $collectionId, string $fieldId): ?array
    {
        return $this->sendRequest('DELETE', "collections/{$collectionId}/fields/{$fieldId}");
    }
}

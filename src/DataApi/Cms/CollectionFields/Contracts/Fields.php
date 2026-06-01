<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionFields\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Fields contract for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Cms\CollectionFields\Contracts
 */
abstract class Fields extends Api
{
    /**
     * Constructor
     *
     * @param string $accessToken The access token
     * @param string $version The version of the API
     * @param string $collectionId The collection ID
     */
    public function __construct(
        string $accessToken,
        string $version,
        protected string $collectionId,
    ) {
        parent::__construct($accessToken, $version);
    }

    /**
     * Create a custom field in a collection.
     *
     * Field validation is currently not available through the API.
     *
     * Bulk creation of fields is not supported with this endpoint. To add multiple fields at once, include them when you create the collection.
     *
     * @param string $collectionId Unique identifier for a Collection
     * @param array $field This can be static field, option field, or reference field
     */
    abstract public function createField(string $collectionId, array $field): ?array;

    /**
     * Update a custom field in a collection.
     *
     * @param string $collectionId Unique identifier for a Collection
     * @param string $fieldId Unique identifier for a Field in a collection
     * @param array $field The updated field data
     */
    abstract public function updateField(string $collectionId, string $fieldId, array $field): ?array;

    /**
     * Delete a custom field in a collection. This endpoint does not currently support bulk deletion.
     *
     * @param string $collectionId Unique identifier for a Collection
     * @param string $fieldId Unique identifier for a Field in a collection
     */
    abstract public function deleteField(string $collectionId, string $fieldId): ?array;
}

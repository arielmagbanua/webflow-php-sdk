<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\PagesComponents;

use ArielMagbanua\PhpWebflowApi\DataApi\PagesComponents\Contracts\Pages as PagesContract;

/**
 * The Pages class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\PagesComponents
 * @todo Create a test for this class
 */
class Pages extends PagesContract
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
     * List of all pages for a site.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/pages/list
     *
     * @param string $siteId Unique identifier for a Site
     * @param string|null $localeId Unique identifier for a specific Locale
     * @param int|null $limit Maximum number of records to be returned (max limit: 100)
     * @param int|null $offset Offset used for pagination if the results have more than limit records
     */
    public function listPages(string $siteId, ?string $localeId = null, ?int $limit = null, ?int $offset = null): ?array
    {
        $query = [];

        // add the localeId to the query if it is not null
        if ($localeId) {
            $query['localeId'] = $localeId;
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
            uri: 'sites/' . $siteId . '/pages',
            query: $query,
        );
    }
}

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

    /**
     * Get metadata information for a single page.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/pages/get-metadata
     *
     * @param string $pageId Unique identifier for a Page
     * @param string|null $localeId Unique identifier for a specific Locale
     */
    public function getPageMetadata(string $pageId, ?string $localeId = null): ?array
    {
        $query = [];

        // add the localeId to the query if it is not null
        if ($localeId) {
            $query['localeId'] = $localeId;
        }

        return $this->sendRequest(
            method: 'GET',
            uri: 'pages/' . $pageId,
            query: $query,
        );
    }

    /**
     * Update Page-level metadata, including SEO and Open Graph fields.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/pages-and-components/pages/update-page-settings
     *
     * Example $metadata structure:
     *
     * ```php
     * $metadata = [
     *      'title' => 'Guide to the Galaxy',
     *      'slug' => 'guide-to-the-galaxy',
     *      'seo' => [
     *          'title' => 'The Ultimate Hitchhiker\'s Guide to the Galaxy',
     *          'description' => 'Everything you need to know about the galaxy, from avoiding Vogon poetry to the importance of towels.'
     *      ],
     *      'openGraph' => [
     *          'title' => 'Explore the Cosmos with The Ultimate Guide',
     *          'titleCopied' => false,
     *          'description' => 'Dive deep into the mysteries of the universe with your guide to everything galactic.',
     *          'descriptionCopied' => false
     *      ]
     * ];
     *
     * @param string $pageId Unique identifier for a Page
     * @param array $metadata The updated metadata
     * @param string|null $localeId Unique identifier for a specific Locale
     */
    public function updatePageMetadata(string $pageId, array $metadata, ?string $localeId = null): ?array
    {
        $query = [];

        // add the localeId to the query if it is not null
        if ($localeId) {
            $query['localeId'] = $localeId;
        }

        return $this->sendRequest(
            method: 'PUT',
            uri: 'pages/' . $pageId,
            body: $metadata,
            query: $query,
        );
    }
}

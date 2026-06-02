<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Sites\Contracts;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Sites contract for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Sites\Contracts
 */
abstract class Sites extends Api
{
    /**
     * The Sites constructor
     *
     * @param string $accessToken The access token
     * @param string $version The version of the API
     */
    public function __construct(string $accessToken, string $version)
    {
        parent::__construct(accessToken: $accessToken, version: $version);
    }

    /**
     * List of all sites the provided access token is able to access.
     */
    abstract public function listSites(): ?array;

    /**
     * Get details of a site.
     *
     * @param string $siteId The site ID
     */
    abstract public function getSite(string $siteId): ?array;

    /**
     * Get a list of all custom domains related to site.
     *
     * @param string $siteId The site ID
     */
    abstract public function getCustomDomains(string $siteId): ?array;

    /**
     * Publishes a site or an individual page to one or more domains.
     * If multiple individual pages are published to staging, publishing from staging to production publishes all staged changes.
     *
     * @param string $siteId The site ID
     * @param array<string> $customDomains The custom domains to publish
     * @param string|null $pageId The page ID to publish
     * @param bool $publishToWebflowSubdomain Whether to publish to the Webflow subdomain
     */
    abstract public function publishSite(string $siteId, array $customDomains, ?string $pageId = null, bool $publishToWebflowSubdomain = false): ?array;
}

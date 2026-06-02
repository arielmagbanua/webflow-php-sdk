<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Sites;

use ArielMagbanua\PhpWebflowApi\DataApi\Sites\Contracts\Sites as SitesContract;

/**
 * The Sites class for the Webflow API
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Sites
 * @todo Create a test for this class
 */
class Sites extends SitesContract
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
     * List of all sites the provided access token is able to access.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/sites/list
     */
    public function listSites(): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'sites',
        );
    }

    /**
     * Get details of a site.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/sites/get
     *
     * @param string $siteId The site ID
     */
    public function getSite(string $siteId): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'sites/' . $siteId,
        );
    }

    /**
     * Get a list of all custom domains related to site.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/sites/get-custom-domain
     *
     * @param string $siteId The site ID
     */
    public function getCustomDomains(string $siteId): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'sites/' . $siteId . '/custom_domains',
        );
    }

    /**
     * Publishes a site or an individual page to one or more domains.
     * If multiple individual pages are published to staging, publishing from staging to production publishes all staged changes.
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/sites/publish
     *
     * @param string $siteId The site ID
     * @param array<string> $customDomains The custom domains to publish
     * @param string|null $pageId The page ID to publish
     * @param bool $publishToWebflowSubdomain Whether to publish to the Webflow subdomain
     */
    public function publishSite(string $siteId, array $customDomains, ?string $pageId = null, bool $publishToWebflowSubdomain = false): ?array
    {
        $payload = [
            'customDomains' => $customDomains,
            'publishToWebflowSubdomain' => $publishToWebflowSubdomain,
        ];

        if ($pageId) {
            $payload['pageId'] = $pageId;
        }

        return $this->sendRequest(
            method: 'POST',
            uri: 'sites/' . $siteId . '/publish',
            body: $payload,
        );
    }
}

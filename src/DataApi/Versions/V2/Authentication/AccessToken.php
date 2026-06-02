<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Authentication;

/**
 * The AccessToken class for the Webflow API
 *
 * This class is used to store the access token and refresh token.
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Authentication
 */
class AccessToken
{
    /**
     * The AccessToken constructor
     *
     * @param string $accessToken The access token
     * @param string|null $tokenType The token type
     * @param array<string> $scopes The OAuth scopes
     */
    public function __construct(
        protected string $accessToken,
        protected ?string $tokenType,
        protected ?array $scopes = [],
    ) {
        //
    }

    /**
     * Get the access token
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * Get the token type
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * Get the scopes
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }
}

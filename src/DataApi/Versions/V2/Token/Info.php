<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Token;

use ArielMagbanua\PhpWebflowApi\DataApi\Api;

/**
 * The Token class for retrieving Authorization information.
 *
 * @package ArielMagbanua\PhpWebflowApi\DataApi\Versions\V2\Token
 */
class Info extends Api
{
    /**
     * The Token constructor
     *
     * @param string $accessToken The access token
     */
    public function __construct(protected string $accessToken)
    {
        parent::__construct(accessToken: $accessToken, version: 'v2');
    }

    /**
     * Information about the Authorized User
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/token/authorized-by
     */
    public function getAuthorizationUserInfo(): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'token/authorized_by',
        );
    }

    /**
     * Information about the authorization token
     *
     * @link https://developers.webflow.com/data/v2.0.0/reference/token/introspect
     */
    public function getAuthorizationInfo(): ?array
    {
        return $this->sendRequest(
            method: 'GET',
            uri: 'token/introspect',
        );
    }
}

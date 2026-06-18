<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\Helpers;

use InvalidArgumentException;

/**
 * The WebHookSignature class for the Webflow API
 *
 * This class is used to verify the Webflow webhook request signature.
 *
 * @package ArielMagbanua\PhpWebflowApi\Helpers
 */
class WebHookSignature
{
    /**
     * OAuth application’s client secret (or your secret key if the webhook is not associated with an OAuth Application)
     *
     * @var string|null
     */
    private ?string $secret;

    /**
     * @param string|null $secret The OAuth application client secret or Webhook secret key
     */
    public function __construct(?string $secret = null)
    {
        $this->secret = $secret;
    }

    /**
     * Set the secret key
     *
     * @param string|null $secret The secret key
     */
    public function setSecret(?string $secret): self
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Generate the HMAC-SHA256 signature for the given timestamp and payload.
     *
     * @param string $timestamp The x-webflow-timestamp header value (Unix timestamp in milliseconds)
     * @param string $payload The raw string request body
     * @param string|null $secret Optional secret key to override the constructor-level secret
     * @throws InvalidArgumentException if no secret key is provided
     */
    public function generate(string $timestamp, string $payload, ?string $secret = null): string
    {
        $signingKey = $secret ?? $this->secret;
        if ($signingKey === null || $signingKey === '') {
            throw new InvalidArgumentException('A secret key is required to generate the signature.');
        }

        $data = $timestamp . ':' . $payload;

        return hash_hmac('sha256', $data, $signingKey);
    }

    /**
     * Verify the Webflow webhook request signature.
     *
     * @param string $signature The x-webflow-signature header value
     * @param string $timestamp The x-webflow-timestamp header value (Unix timestamp in milliseconds)
     * @param string $payload The raw string request body
     * @param string|null $secret Optional secret key to override the constructor-level secret
     * @param int $toleranceMs Tolerance window in milliseconds (default: 5 minutes / 300,000ms)
     * @throws InvalidArgumentException if no secret key is provided
     */
    public function verify(
        string $signature,
        string $timestamp,
        string $payload,
        ?string $secret = null,
        int $toleranceMs = 300000
    ): bool {
        // 1. generate the HMAC hash
        $expectedSignature = $this->generate($timestamp, $payload, $secret);

        // 2. compare the generated hash with the provided signature
        if (!hash_equals($expectedSignature, $signature)) {
            return false;
        }

        // 3. verify the timestamp (within the tolerance window)
        $currentTimeMs = (int) round(microtime(true) * 1000);
        $timestampMs = (int) $timestamp;

        if (abs($currentTimeMs - $timestampMs) > $toleranceMs) {
            return false;
        }

        return true;
    }
}

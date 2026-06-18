<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\Tests\Unit\Services;

use ArielMagbanua\PhpWebflowApi\Helpers\WebHookSignature;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WebHookSignatureTest extends TestCase
{
    private string $secret = 'test_secret_key';
    private string $payload = '{"triggerType":"form_submission","payload":{"name":"Contact Us"}}';

    public function testVerifyWithConstructorSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $data = $timestamp . ':' . $this->payload;
        $signature = hash_hmac('sha256', $data, $this->secret);

        $validator = new WebHookSignature($this->secret);
        $this->assertTrue($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyWithMethodSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $data = $timestamp . ':' . $this->payload;
        $signature = hash_hmac('sha256', $data, $this->secret);

        $validator = new WebHookSignature();
        $this->assertTrue($validator->verify($signature, $timestamp, $this->payload, $this->secret));
    }

    public function testVerifyInvalidSignature(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $signature = 'invalid_signature_hash_value';

        $validator = new WebHookSignature($this->secret);
        $this->assertFalse($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyExpiredTimestamp(): void
    {
        // 6 minutes ago (360,000 ms)
        $currentTimeMs = (int) round(microtime(true) * 1000);
        $timestamp = (string) ($currentTimeMs - 360000);

        $data = $timestamp . ':' . $this->payload;
        $signature = hash_hmac('sha256', $data, $this->secret);

        $validator = new WebHookSignature($this->secret);
        $this->assertFalse($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyFutureTimestamp(): void
    {
        // 6 minutes in the future (360,000 ms)
        $currentTimeMs = (int) round(microtime(true) * 1000);
        $timestamp = (string) ($currentTimeMs + 360000);

        $data = $timestamp . ':' . $this->payload;
        $signature = hash_hmac('sha256', $data, $this->secret);

        $validator = new WebHookSignature($this->secret);
        $this->assertFalse($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyMissingSecretThrowsException(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $data = $timestamp . ':' . $this->payload;
        $signature = hash_hmac('sha256', $data, $this->secret);

        $validator = new WebHookSignature();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A secret key is required to verify the signature.');

        $validator->verify($signature, $timestamp, $this->payload);
    }
}

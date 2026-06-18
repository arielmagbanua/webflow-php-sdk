<?php

declare(strict_types=1);

namespace ArielMagbanua\PhpWebflowApi\Tests\Unit\Services;

use ArielMagbanua\PhpWebflowApi\Helpers\WebHookSignature;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class WebHookSignatureTest extends TestCase
{
    private string $secret = 'test_secret_key';
    private string $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $payloadPath = __DIR__ . '/../../payloads/webhookRequestPayload.json';
        $payloadContent = file_get_contents($payloadPath);
        if ($payloadContent === false) {
            throw new RuntimeException('Could not load webhookRequestPayload.json');
        }

        // Minimize the JSON content to represent standard raw POST payload string structure
        $decoded = json_decode($payloadContent, true);
        $encoded = json_encode($decoded);
        if ($encoded === false) {
            throw new RuntimeException('Failed to re-encode JSON payload');
        }

        $this->payload = $encoded;
    }

    public function testGenerateWithConstructorSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $generator = new WebHookSignature($this->secret);

        $expectedSignature = hash_hmac('sha256', $timestamp . ':' . $this->payload, $this->secret);
        $this->assertEquals($expectedSignature, $generator->generate($timestamp, $this->payload));
    }

    public function testGenerateWithMethodSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $generator = new WebHookSignature();

        $expectedSignature = hash_hmac('sha256', $timestamp . ':' . $this->payload, $this->secret);
        $this->assertEquals($expectedSignature, $generator->generate($timestamp, $this->payload, $this->secret));
    }

    public function testGenerateMissingSecretThrowsException(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $generator = new WebHookSignature();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A secret key is required to generate the signature.');

        $generator->generate($timestamp, $this->payload);
    }

    public function testVerifyWithConstructorSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $validator = new WebHookSignature($this->secret);
        $signature = $validator->generate($timestamp, $this->payload);

        $this->assertTrue($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyWithMethodSecretSuccess(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $validator = new WebHookSignature();
        $signature = $validator->generate($timestamp, $this->payload, $this->secret);

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

        $validator = new WebHookSignature($this->secret);
        $signature = $validator->generate($timestamp, $this->payload);

        $this->assertFalse($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyFutureTimestamp(): void
    {
        // 6 minutes in the future (360,000 ms)
        $currentTimeMs = (int) round(microtime(true) * 1000);
        $timestamp = (string) ($currentTimeMs + 360000);

        $validator = new WebHookSignature($this->secret);
        $signature = $validator->generate($timestamp, $this->payload);

        $this->assertFalse($validator->verify($signature, $timestamp, $this->payload));
    }

    public function testVerifyMissingSecretThrowsException(): void
    {
        $timestamp = (string) round(microtime(true) * 1000);
        $validator = new WebHookSignature();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A secret key is required to generate the signature.');

        $validator->verify('some_signature', $timestamp, $this->payload);
    }
}

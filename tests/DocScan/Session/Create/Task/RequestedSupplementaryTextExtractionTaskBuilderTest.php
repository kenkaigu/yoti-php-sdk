<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Create\Task;

use Yoti\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTaskBuilder
 */
class RequestedSupplementaryTextExtractionTaskBuilderTest extends TestCase
{
    private const SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION = 'SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION';
    private const SOME_MANUAL_CHECK = 'someManualCheck';
    private const ALWAYS = 'ALWAYS';
    private const FALLBACK = 'FALLBACK';
    private const NEVER = 'NEVER';

    /**
     * @test
     * @covers ::withManualCheck
     * @covers ::build
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::__construct
     */
    public function shouldBuildCorrectlyWithoutException()
    {
        $result = (new RequestedSupplementaryTextExtractionTaskBuilder())
            ->withManualCheck(self::SOME_MANUAL_CHECK)
            ->build();

        $this->assertInstanceOf(RequestedSupplementaryTextExtractionTask::class, $result);
    }

    /**
     * @test
     * @covers ::withManualCheckAlways
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::jsonSerialize
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getType
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getConfig
     */
    public function shouldUseAlwaysAsValueForManualCheck()
    {
        $result = (new RequestedSupplementaryTextExtractionTaskBuilder())
            ->withManualCheckAlways()
            ->build();

        $expected = [
            'type' => self::SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION,
            'config' => [
                'manual_check' => self::ALWAYS,
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers ::withManualCheckFallback
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::jsonSerialize
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getType
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getConfig
     */
    public function shouldUseFallbackAsValueForManualCheck()
    {
        $result = (new RequestedSupplementaryTextExtractionTaskBuilder())
            ->withManualCheckFallback()
            ->build();

        $expected = [
            'type' => self::SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION,
            'config' => [
                'manual_check' => self::FALLBACK,
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers ::withManualCheckNever
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::jsonSerialize
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getType
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::getConfig
     */
    public function shouldUseNeverAsValueForManualCheck()
    {
        $result = (new RequestedSupplementaryTextExtractionTaskBuilder())
            ->withManualCheckNever()
            ->build();

        $expected = [
            'type' => self::SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION,
            'config' => [
                'manual_check' => self::NEVER,
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\DocScan\Session\Create\Task\RequestedSupplementaryTextExtractionTask::__toString
     */
    public function shouldCreateCorrectString()
    {
        $result = (new RequestedSupplementaryTextExtractionTaskBuilder())
            ->withManualCheck(self::SOME_MANUAL_CHECK)
            ->build();

        $expected = [
            'type' => self::SUPPLEMENTARY_DOCUMENT_TEXT_DATA_EXTRACTION,
            'config' => [
                'manual_check' => self::SOME_MANUAL_CHECK,
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $result->__toString());
    }
}

<?php

declare(strict_types=1);

namespace Yoti\Test\DocScan\Session\Retrieve;

use Yoti\DocScan\Session\Retrieve\DocumentFileResponse;
use Yoti\DocScan\Session\Retrieve\MediaResponse;
use Yoti\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\DocScan\Session\Retrieve\DocumentFileResponse
 */
class DocumentFileResponseTest extends TestCase
{

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMedia
     */
    public function shouldBuildCorrectly()
    {
        $result = new DocumentFileResponse([
            'media' => [],
        ]);

        $this->assertInstanceOf(MediaResponse::class, $result->getMedia());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getMedia
     */
    public function shouldNotThrowExceptionWhenMediaMissing()
    {
        $result = new DocumentFileResponse([]);

        $this->assertNull($result->getMedia());
    }
}

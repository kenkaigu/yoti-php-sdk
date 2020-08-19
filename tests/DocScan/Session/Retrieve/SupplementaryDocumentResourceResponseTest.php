<?php

declare(strict_types=1);

namespace Yoti\Test\DocScan\Session\Retrieve;

use Yoti\DocScan\Session\Retrieve\DocumentFieldsResponse;
use Yoti\DocScan\Session\Retrieve\DocumentFileResponse;
use Yoti\DocScan\Session\Retrieve\SupplementaryDocumentResourceResponse;
use Yoti\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\DocScan\Session\Retrieve\SupplementaryDocumentResourceResponse
 */
class SupplementaryDocumentResourceResponseTest extends TestCase
{

    private const SOME_DOCUMENT_TYPE = 'someDocumentType';
    private const SOME_ISSUING_COUNTRY = 'someIssuingCountry';

    /**
     * @test
     * @covers ::__construct
     * @covers ::getDocumentType
     * @covers ::getIssuingCountry
     * @covers ::getPages
     * @covers ::getDocumentFields
     * @covers ::getFile
     * @covers \Yoti\DocScan\Session\Retrieve\DocumentResourceResponse::__construct
     */
    public function shouldBuildCorrectly()
    {
        $input = [
            'document_type' => self::SOME_DOCUMENT_TYPE,
            'issuing_country' => self::SOME_ISSUING_COUNTRY,
            'document_id_photo' => [],
            'pages' => [
                [],
                []
            ],
            'document_fields' => [],
            'file' => [],
        ];

        $result = new SupplementaryDocumentResourceResponse($input);

        $this->assertEquals(self::SOME_DOCUMENT_TYPE, $result->getDocumentType());
        $this->assertEquals(self::SOME_ISSUING_COUNTRY, $result->getIssuingCountry());
        $this->assertCount(2, $result->getPages());
        $this->assertInstanceOf(DocumentFieldsResponse::class, $result->getDocumentFields());
        $this->assertInstanceOf(DocumentFileResponse::class, $result->getFile());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers \Yoti\DocScan\Session\Retrieve\DocumentResourceResponse::__construct
     */
    public function shouldNotThrowExceptionWhenMissingValues()
    {
        $result = new SupplementaryDocumentResourceResponse([]);

        $this->assertNull($result->getDocumentType());
        $this->assertNull($result->getIssuingCountry());
        $this->assertCount(0, $result->getPages());
        $this->assertNull($result->getDocumentFields());
        $this->assertNull($result->getFile());
    }
}

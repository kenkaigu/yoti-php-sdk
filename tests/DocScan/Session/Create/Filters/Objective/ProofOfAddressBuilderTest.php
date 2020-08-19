<?php

namespace Yoti\Test\DocScan\Session\Create\Check\Filters\Document;

use Yoti\DocScan\Session\Create\Filters\Objective;
use Yoti\DocScan\Session\Create\Filters\Objective\ProofOfAddress;
use Yoti\DocScan\Session\Create\Filters\Objective\ProofOfAddressBuilder;
use Yoti\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\DocScan\Session\Create\Filters\Objective\ProofOfAddressBuilder
 */
class ProofOfAddressBuilderTest extends TestCase
{
    private const PROOF_OF_ADDRESS = 'PROOF_OF_ADDRESS';

    /**
     * @test
     *
     * @covers ::build
     * @covers \Yoti\DocScan\Session\Create\Filters\Objective::__construct
     * @covers \Yoti\DocScan\Session\Create\Filters\Objective::jsonSerialize
     * @covers \Yoti\DocScan\Session\Create\Filters\Objective\ProofOfAddress::__construct
     * @covers \Yoti\DocScan\Session\Create\Filters\Objective\ProofOfAddress::jsonSerialize
     */
    public function shouldBuildProofOfAddress()
    {
        $proofOfAddress = (new ProofOfAddressBuilder())->build();

        $this->assertInstanceOf(ProofOfAddress::class, $proofOfAddress);
        $this->assertInstanceOf(Objective::class, $proofOfAddress);

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                (object) [
                    'type' => self::PROOF_OF_ADDRESS,
                ]
            ),
            json_encode($proofOfAddress)
        );
    }
}

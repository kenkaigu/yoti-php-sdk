<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Create\Filters\Objective;

class ProofOfAddressBuilder
{
    /**
     * @return ProofOfAddress
     */
    public function build(): ProofOfAddress
    {
        return new ProofOfAddress();
    }
}

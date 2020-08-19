<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Create\Filters\Objective;

use Yoti\DocScan\Session\Create\Filters\Objective;

class ProofOfAddress extends Objective
{
    private const TYPE = 'PROOF_OF_ADDRESS';

    public function __construct()
    {
        parent::__construct(self::TYPE);
    }
}

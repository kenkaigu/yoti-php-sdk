<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Create\Task;

use Yoti\DocScan\Session\Create\Traits\Builder\ManualCheckTrait;
use Yoti\Util\Validation;

class RequestedSupplementaryTextExtractionTaskBuilder
{
    use ManualCheckTrait;

    /**
     * @return RequestedSupplementaryTextExtractionTask
     */
    public function build(): RequestedSupplementaryTextExtractionTask
    {
        Validation::notEmptyString($this->manualCheck, 'manualCheck');

        $config = new RequestedSupplementaryTextExtractionTaskConfig($this->manualCheck);
        return new RequestedSupplementaryTextExtractionTask($config);
    }
}

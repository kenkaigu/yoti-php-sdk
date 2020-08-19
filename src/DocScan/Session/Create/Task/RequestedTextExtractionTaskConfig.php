<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Create\Task;

class RequestedTextExtractionTaskConfig extends BaseTextExtractionTaskConfig
{
    /**
     * @var string|null
     */
    private $chipData;

    /**
     * @param string $manualCheck
     * @param string|null $chipData
     */
    public function __construct(string $manualCheck, ?string $chipData = null)
    {
        parent::__construct($manualCheck);
        $this->chipData = $chipData;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $jsonData = parent::jsonSerialize();

        if ($this->getChipData() !== null) {
            $jsonData['chip_data'] = $this->getChipData();
        }

        return $jsonData;
    }

    /**
     * @return string
     */
    public function getChipData(): ?string
    {
        return $this->chipData;
    }
}

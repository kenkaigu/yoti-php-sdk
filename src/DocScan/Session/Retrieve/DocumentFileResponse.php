<?php

declare(strict_types=1);

namespace Yoti\DocScan\Session\Retrieve;

class DocumentFileResponse
{
    /**
     * @var MediaResponse|null
     */
    private $media;

    /**
     * @param array<string, mixed> $documentFile
     */
    public function __construct(array $documentFile)
    {
        $this->media = isset($documentFile['media'])
            ? new MediaResponse($documentFile['media'])
            : null;
    }

    /**
     * @return MediaResponse|null
     */
    public function getMedia(): ?MediaResponse
    {
        return $this->media;
    }
}

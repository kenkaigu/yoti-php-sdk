<?php

namespace Yoti\DocScan\Session\Retrieve;

class SupplementaryDocumentResourceResponse extends DocumentResourceResponse
{
    /**
     * @var DocumentFileResponse|null
     */
    private $documentFile;

    /**
     * @param array<string, mixed> $document
     */
    public function __construct(array $document)
    {
        parent::__construct($document);

        $this->documentFile = isset($document['file'])
            ? new DocumentFileResponse($document['file'])
            : null;
    }

    /**
     * @return DocumentFileResponse|null
     */
    public function getFile(): ?DocumentFileResponse
    {
        return $this->documentFile;
    }
}

<?php

namespace Yoti\DocScan\Session\Retrieve;

class IdDocumentResourceResponse extends DocumentResourceResponse
{
    /**
     * @var DocumentIdPhotoResponse|null
     */
    private $documentIdPhoto;

    /**
     * @param array<string, mixed> $document
     */
    public function __construct(array $document)
    {
        parent::__construct($document);

        $this->documentIdPhoto = isset($document['document_id_photo'])
            ? new DocumentIdPhotoResponse($document['document_id_photo'])
            : null;
    }

    /**
     * @return DocumentIdPhotoResponse|null
     */
    public function getDocumentIdPhoto(): ?DocumentIdPhotoResponse
    {
        return $this->documentIdPhoto;
    }
}

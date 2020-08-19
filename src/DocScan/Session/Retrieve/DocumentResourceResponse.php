<?php

namespace Yoti\DocScan\Session\Retrieve;

class DocumentResourceResponse extends ResourceResponse
{
    /**
     * @var string|null
     */
    private $documentType;

    /**
     * @var string|null
     */
    private $issuingCountry;

    /**
     * @var PageResponse[]
     */
    private $pages = [];

    /**
     * @var DocumentFieldsResponse|null
     */
    private $documentFields;

    /**
     * @param array<string, mixed> $document
     */
    public function __construct(array $document)
    {
        parent::__construct($document);

        $this->documentType = $document['document_type'] ?? null;
        $this->issuingCountry = $document['issuing_country'] ?? null;

        if (isset($document['pages'])) {
            foreach ($document['pages'] as $page) {
                $this->pages[] = new PageResponse($page);
            }
        }

        $this->documentFields = isset($document['document_fields'])
            ? new DocumentFieldsResponse($document['document_fields'])
            : null;
    }

    /**
     * @return string|null
     */
    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    /**
     * @return string|null
     */
    public function getIssuingCountry(): ?string
    {
        return $this->issuingCountry;
    }

    /**
     * @return PageResponse[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @return DocumentFieldsResponse|null
     */
    public function getDocumentFields(): ?DocumentFieldsResponse
    {
        return $this->documentFields;
    }
}

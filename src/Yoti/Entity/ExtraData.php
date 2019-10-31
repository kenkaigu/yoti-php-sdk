<?php

namespace Yoti\Entity;

use Yoti\Util\Validation;

class ExtraData
{
    /**
     * @var mixed[]
     */
    private $dataEntryList = [];

    /**
     * @param mixed[] $dataEntryList
     */
    public function __construct(array $dataEntryList)
    {
        Validation::isArrayOfType($dataEntryList, [AttributeIssuanceDetails::class], 'dataEntryList');
        $this->dataEntryList = $dataEntryList;
    }

    /**
     * @return \Yoti\Entity\AttributeIssuanceDetails|null
     */
    public function getAttributeIssuanceDetails()
    {
        $attributeIssuanceDetails = array_filter(
            $this->dataEntryList,
            function ($dataEntry) {
                return $dataEntry instanceof AttributeIssuanceDetails;
            }
        );

        return reset($attributeIssuanceDetails) ?: null;
    }
}
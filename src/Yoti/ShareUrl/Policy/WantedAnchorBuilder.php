<?php

namespace Yoti\ShareUrl\Policy;

/**
 * Builder for WantedAnchor.
 */
class WantedAnchorBuilder
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $subType = '';

    /**
     * @param string $value
     */
    public function withValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $subType
     */
    public function withSubType($subType)
    {
        $this->subType = $subType;
        return $this;
    }

    /**
     * @return \Yoti\ShareUrl\Policy\WantedAnchor
     */
    public function build()
    {
        return new WantedAnchor($this->value, $this->subType);
    }
}
<?php

namespace OpenBibIdApi\Value\Number;

use OpenBibIdApi\Value\FromDomNodeListInterface;
use OpenBibIdApi\Value\ValueInterface;

class FloatLiteral implements ValueInterface, FromDomNodeListInterface
{
    /**
     * The float value.
     *
     * @var float
     */
    protected $value;

    /**
     * Creates a new FloatLiteral.
     *
     * @param float $value
     *   The float value.
     */
    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Builds a FloatLiteral object from XML.
     *
     * @param \DOMNodeList $xml
     *   The xml tag containing the float.
     *
     * @return FloatLiteral
     *   The FloatLiteral object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $value = 0;
        if ($xml->length > 0) {
            $value = (float) $xml->item(0)->textContent;
        }
        return new static($value);
    }

    /**
     * Returns the float value.
     *
     * @return float
     *   The float value.
     */
    public function getValue()
    {
        return $this->value;
    }
}

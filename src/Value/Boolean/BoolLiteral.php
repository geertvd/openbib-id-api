<?php

namespace OpenBibIdApi\Value\Boolean;

use OpenBibIdApi\Value\FromDomNodeListInterface;
use OpenBibIdApi\Value\ValueInterface;

class BoolLiteral implements ValueInterface, FromDomNodeListInterface
{
    /**
     * The boolean value.
     *
     * @var bool
     */
    private $value;

    /**
     * Creates a new BoolLiteral.
     *
     * @param bool $value
     *   The boolean value.
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Builds a BoolLiteral object from XML.
     *
     * @param \DOMNodeList $xml
     *   The xml tag containing the boolean.
     *
     * @return BoolLiteral
     *   A BoolLiteral object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $value = false;
        if ($xml->length > 0) {
            $value = $xml->item(0)->textContent === 'true';
        }
        return new static($value);
    }

    /**
     * Gets the boolean value.
     *
     * @return bool
     *   The boolean value.
     */
    public function isTrue()
    {
        return $this->value;
    }
}

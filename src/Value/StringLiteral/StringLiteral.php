<?php

namespace OpenBibIdApi\Value\StringLiteral;

use OpenBibIdApi\Value\FromDomNodeListInterface;
use OpenBibIdApi\Value\ValueInterface;

class StringLiteral implements ValueInterface, FromDomNodeListInterface
{
    /**
     * The string value.
     *
     * @var string
     */
    protected $value;

    /**
     * Creates a new StringLiteral.
     *
     * @param string $value
     *   The string value.
     */
    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Builds a StringLiteral object from XML.
     *
     * @param \DOMNodeList $xml
     *   The xml tag containing the string.
     *
     * @return StringLiteral
     *   The StringLiteral object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $value = '';
        if ($xml->length > 0) {
            $value = $xml->item(0)->textContent;
        }
        return new static($value);
    }

    /**
     * Builds a StringLiteral object from a string.
     *
     * @param string $value
     *   The text value.
     *
     * @return StringLiteral
     *   The StringLiteral object.
     */
    public static function create($value)
    {
        return new static($value);
    }

    /**
     * Returns a string representation of the StringLiteral.
     *
     * @return string
     *   The string value.
     */
    public function __toString()
    {
        return $this->value;
    }
}

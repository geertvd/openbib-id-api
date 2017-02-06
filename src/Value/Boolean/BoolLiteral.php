<?php

namespace OpenBibIdApi\Value\Boolean;

use OpenBibIdApi\Value\ValueInterface;

class BoolLiteral implements ValueInterface
{
    /**
     * The boolean value.
     *
     * @var bool
     */
    protected $value;

    /**
     * Creates a new BoolLiteral.
     *
     * @param bool $value
     *   The boolean value.
     */
    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Builds a BoolLiteral object from XML.
     *
     * @param \DOMNodeList
     *   The xml tag containing the boolean.
     *
     * @return BoolLiteral
     *   A BoolLiteral object.
     */
    public static function fromXml()
    {
        /* @var \DOMNodeList $xml */
        $xml = func_get_arg(0);

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
    public function getValue()
    {
        return $this->value;
    }
}

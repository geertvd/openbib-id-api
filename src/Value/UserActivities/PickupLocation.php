<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\FromDomElement;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class PickupLocation implements ValueInterface, FromDomElement
{
    /**
     * The PBS code of the pickup location.
     *
     * @var StringLiteral
     */
    private $id;

    /**
     * Free text concerning the pickup location.
     *
     * @var StringLiteral
     */
    private $text;

    /**
     * Force the use of static methods to create PickupLocation objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a PickupLocation object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the pickup location.
     *
     * @return PickupLocation
     *   A PickupLocation object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->id = StringLiteral::fromXml($xml->getElementsByTagName('pickupLocation'));
        $static->text = StringLiteral::fromXml($xml->getElementsByTagName('pickupLocationText'));
        return $static;
    }

    /**
     * Gets the PBS code of the pickup location.
     *
     * @return StringLiteral
     *   The PBS code of the pickup location.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets free text concerning the pickup location.
     *
     * @return StringLiteral
     *   Free text concerning the pickup location.
     */
    public function getText()
    {
        return $this->text;
    }

}

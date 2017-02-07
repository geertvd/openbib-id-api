<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\FromDomElementInterface;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class PickupLocation implements ValueInterface, FromDomElementInterface
{
    /**
     * The PBS code of the pickup location.
     *
     * @var StringLiteral
     */
    private $locationId;

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

        $locationId = $xml->getElementsByTagName('pickupLocation');
        $static->locationId = StringLiteral::fromXml($locationId);

        $text = $xml->getElementsByTagName('pickupLocationText');
        $static->text = StringLiteral::fromXml($text);

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
        return $this->locationId;
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

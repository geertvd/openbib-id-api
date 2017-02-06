<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class PickupLocation implements ValueInterface
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
     * PickupLocation constructor.
     *
     * @param StringLiteral $id
     *   The PBS code of the pickup location.
     * @param StringLiteral $text
     *   Free text concerning the pickup location.
     */
    public function __construct(StringLiteral $id, StringLiteral $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    /**
     * Builds a PickupLocation object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the pickup location.
     *
     * @return PickupLocation
     *   A PickupLocation object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            StringLiteral::fromXml($xml->getElementsByTagName('pickupLocation')),
            StringLiteral::fromXml($xml->getElementsByTagName('pickupLocationText'))
        );
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

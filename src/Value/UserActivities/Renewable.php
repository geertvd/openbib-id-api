<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Boolean\BoolLiteral;
use OpenBibIdApi\Value\FromDomElementInterface;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Renewable implements ValueInterface, FromDomElementInterface
{
    /**
     * Whether or not the item is renewable.
     *
     * @var BoolLiteral
     */
    private $isRenewable;

    /**
     * A message concerning the renewable status.
     *
     * @var StringLiteral
     */
    private $message;

    /**
     * The cost to renew the item.
     *
     * @var StringLiteral
     */
    private $cost;

    /**
     * Force the use of static methods to create Renewable objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a Renewable object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the renewable information.
     *
     * @return Renewable
     *   A Renewable object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();

        $isRenewable = $xml->getElementsByTagName('renewable');
        $static->isRenewable = BoolLiteral::fromXml($isRenewable);
        $message = $xml->getElementsByTagName('renewableMessage');
        $static->message = StringLiteral::fromXml($message);
        $cost = $xml->getElementsByTagName('renewalCost');
        $static->cost = StringLiteral::fromXml($cost);

        return $static;
    }

    /**
     * Checks if the item is renewable.
     *
     * @return bool
     *   Whether or not the item is renewable.
     */
    public function isRenewable()
    {
        return $this->isRenewable->isTrue();
    }

    /**
     * Gets a message concerning the renewable status.
     *
     * @return StringLiteral
     *   A message concerning the renewable status.
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Gets the cost to renew the item.
     *
     * @return StringLiteral
     *   The cost to renew the item.
     */
    public function getCost()
    {
        return $this->cost;
    }
}

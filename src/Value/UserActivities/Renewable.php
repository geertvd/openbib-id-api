<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Boolean\BoolLiteral;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Renewable implements ValueInterface
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
     * Creates a new Renewable.
     *
     * @param BoolLiteral $isRenewable
     *   Whether or not the item is renewable.
     * @param StringLiteral $message
     *   A message concerning the renewable status.
     * @param StringLiteral $cost
     *   The cost to renew the item.
     */
    public function __construct(
        BoolLiteral $isRenewable,
        StringLiteral $message,
        StringLiteral $cost
    ) {
        $this->isRenewable = $isRenewable;
        $this->message = $message;
        $this->cost = $cost;
    }


    /**
     * Builds a Renewable object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the renewable information.
     *
     * @return Renewable
     *   A Renewable object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            BoolLiteral::fromXml($xml->getElementsByTagName('renewable')),
            StringLiteral::fromXml($xml->getElementsByTagName('renewableMessage')),
            StringLiteral::fromXml($xml->getElementsByTagName('renewalCost'))
        );
    }

    /**
     * Checks if the item is renewable.
     *
     * @return bool
     *   Whether or not the item is renewable.
     */
    public function isRenewable()
    {
        return $this->isRenewable->getValue();
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

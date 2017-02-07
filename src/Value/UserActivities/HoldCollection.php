<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\ValueInterface;

class HoldCollection extends ActivityCollection implements ValueInterface
{
    /**
     * Builds a HoldCollection object from XML.
     *
     * @param \DOMNodeList $xml
     *   The list of xml tags representing the holds.
     *
     * @return HoldCollection
     *   A HoldCollection object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Hold::fromXml($xmlTag);
        }
        return new static($items);
    }
}

<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\ValueInterface;

class HoldCollection extends ActivityCollection implements ValueInterface
{
    /**
     * Builds a HoldCollection object from XML.
     *
     * @param \DOMNodeList
     *   The list of xml tags representing the holds.
     *
     * @return HoldCollection
     *   A HoldCollection object.
     */
    public static function fromXml()
    {
        /* @var \DOMNodeList $xml */
        $xml = func_get_arg(0);

        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Hold::fromXml($xmlTag);
        }
        return new static($items);
    }
}

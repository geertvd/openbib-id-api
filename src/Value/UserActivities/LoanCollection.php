<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\ValueInterface;

class LoanCollection extends ActivityCollection implements ValueInterface
{
    /**
     * Builds a LoanCollection object from XML.
     *
     * @param \DOMNodeList $xml
     *   The list of xml tags representing the loans.
     *
     * @return LoanCollection
     *   A LoanCollection object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Loan::fromXml($xmlTag);
        }
        return new static($items);
    }
}

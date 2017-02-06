<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\ValueInterface;

class LoanCollection extends ActivityCollection implements ValueInterface
{
    /**
     * Builds a LoanCollection object from XML.
     *
     * @param \DOMNodeList
     *   The list of xml tags representing the loans.
     *
     * @return LoanCollection
     *   A LoanCollection object.
     */
    public static function fromXml()
    {
        /* @var \DOMNodeList $xml */
        $xml = func_get_arg(0);

        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Loan::fromXml($xmlTag);
        }
        return new static($items);
    }
}

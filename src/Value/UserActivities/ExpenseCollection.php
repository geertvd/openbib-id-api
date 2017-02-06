<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Structure\Collection;
use OpenBibIdApi\Value\ValueInterface;

class ExpenseCollection extends Collection implements ValueInterface
{
    /**
     * Builds a ExpenseCollection object from XML.
     *
     * @param \DOMNodeList
     *   The list of xml tags representing the expenses.
     *
     * @return ExpenseCollection
     *   A ExpenseCollection object
     */
    public static function fromXml()
    {
        /* @var \DOMNodeList $xml */
        $xml = func_get_arg(0);

        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Expense::fromXml($xmlTag);
        }
        return new static($items);
    }
}

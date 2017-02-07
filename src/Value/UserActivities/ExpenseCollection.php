<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Structure\Collection;

class ExpenseCollection extends Collection
{
    /**
     * Builds a ExpenseCollection object from XML.
     *
     * @param \DOMNodeList $xml
     *   The list of xml tags representing the expenses.
     *
     * @return ExpenseCollection
     *   A ExpenseCollection object
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = Expense::fromXml($xmlTag);
        }
        return new static($items);
    }
}

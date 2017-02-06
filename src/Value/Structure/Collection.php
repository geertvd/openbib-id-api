<?php

namespace OpenBibIdApi\Value\Structure;

use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Collection implements \IteratorAggregate, ValueInterface
{
    /**
     * An array of objects implementing ValueInterface.
     *
     * @var ValueInterface[]
     */
    private $items;

    /**
     * Creates a new collection.
     *
     * @param ValueInterface[] $items
     *   An array of objects implementing ValueInterface.
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Builds a Collection object from XML.
     *
     * @param \DOMNodeList
     *   The list of xml tags.
     *
     * @return Collection
     *   A Collection object.
     */
    public static function fromXml()
    {
        /* @var \DOMNodeList $xml */
        $xml = func_get_arg(0);

        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = StringLiteral::fromXml($xmlTag);
        }
        return new static($items);
    }


  /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

}

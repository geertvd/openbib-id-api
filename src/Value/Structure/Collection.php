<?php

namespace OpenBibIdApi\Value\Structure;

use OpenBibIdApi\Value\ValueInterface;

class Collection implements \IteratorAggregate
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
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

}

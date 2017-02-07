<?php

namespace OpenBibIdApi\Value\Structure;

use OpenBibIdApi\Value\FromDomNodeListInterface;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Collection implements \IteratorAggregate, ValueInterface, FromDomNodeListInterface
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
    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Builds a Collection object from XML.
     *
     * @param \DOMNodeList $xml
     *   The list of xml tags.
     *
     * @return Collection
     *   A Collection object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $items = array();
        foreach ($xml as $xmlTag) {
            $items[] = StringLiteral::create($xmlTag->textContent);
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

    /**
     * Gets the first item from the collection.
     *
     * @return StringLiteral|false
     *   The first item from the collection, false if the collection is empty.
     */
    public function first()
    {
        $this->getIterator()->rewind();
        return $this->getIterator()->count() ? $this->getIterator()
            ->current() : false;
    }
}

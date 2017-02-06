<?php
namespace OpenBibIdApi\Value;

interface ValueInterface
{
    /**
     * Builds a value object from XML.
     *
     * @return ValueInterface
     *   A ValueInterface object.
     */
    public static function fromXml();
}

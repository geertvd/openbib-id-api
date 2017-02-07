<?php
namespace OpenBibIdApi\Value;

interface FromDomDocument
{
    /**
     * Builds a ValueInterface from XML.
     *
     * @param \DOMDocument $xml
     *   A DOMDocument object.
     *
     * @return ValueInterface
     *   An object implementing ValueInterface.
     */
    public static function fromXml(\DOMDocument $xml);
}

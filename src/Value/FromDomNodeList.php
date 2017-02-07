<?php
namespace OpenBibIdApi\Value;

interface FromDomNodeList
{
    /**
     * Builds a ValueInterface from XML.
     *
     * @param \DOMNodeList $xml
     *   A DOMNodeList object.
     *
     * @return ValueInterface
     *   An object implementing ValueInterface.
     */
    public static function fromXml(\DOMNodeList $xml);
}
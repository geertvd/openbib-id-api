<?php
namespace OpenBibIdApi\Value;

interface FromDomElementInterface
{
    /**
     * Builds a ValueInterface from XML.
     *
     * @param \DOMElement $xml
     *   A DOMElement object.
     *
     * @return ValueInterface
     *   An object implementing ValueInterface.
     */
    public static function fromXml(\DOMElement $xml);
}

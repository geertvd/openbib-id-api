<?php
namespace OpenBibIdApi\Value;

interface FromDomDocumentInterface
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

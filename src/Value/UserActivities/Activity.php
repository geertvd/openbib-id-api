<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\FromDomElementInterface;
use OpenBibIdApi\Value\ValueInterface;

class Activity implements ValueInterface, FromDomElementInterface
{
    /**
     * Metadata concerning the library item.
     *
     * @var LibraryItemMetadata
     */
    protected $libraryItemMetadata;

    /**
     * Force the use of static methods to create Activity objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a Activity object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the activity.
     *
     * @return Activity
     *   An Activity object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->libraryItemMetadata = LibraryItemMetadata::fromXml($xml);
        return $static;
    }

    /**
     * Gets metadata concerning the library item.
     *
     * @return LibraryItemMetadata
     *   Metadata concerning the library item.
     */
    public function getLibraryItemMetadata()
    {
        return $this->libraryItemMetadata;
    }
}

<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\ValueInterface;

class Activity implements ValueInterface
{
    /**
     * Metadata concerning the library item.
     *
     * @var LibraryItemMetadata
     */
    private $libraryItemMetadata;

    /**
     * Creates a new activity object.
     *
     * @param LibraryItemMetadata $libraryItemMetadata
     *   Metadata concerning the library item.
     */
    protected function __construct($libraryItemMetadata)
    {
        $this->libraryItemMetadata = $libraryItemMetadata;
    }

    /**
     * Builds a Activity object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the activity.
     *
     * @return Activity
     *   An Activity object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            LibraryItemMetadata::fromXml($xml)
        );
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

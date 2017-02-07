<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\FromDomElement;
use OpenBibIdApi\Value\StringLiteral\Path;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class LibraryItemMetadata implements ValueInterface, FromDomElement
{
    /**
     * The title of the library item.
     *
     * @var StringLiteral
     */
    private $title;

    /**
     * The author of the library item.
     *
     * @var StringLiteral
     */
    private $author;

    /**
     * The year the library item was published.
     *
     * @var StringLiteral
     */
    private $year;

    /**
     * The library item's imprint.
     *
     * @var StringLiteral
     */
    private $imprint;

    /**
     * The path to the library item's detail page.
     *
     * @var Path
     */
    private $url;

    /**
     * The ISBN or ISSN number of the library item.
     *
     * @var StringLiteral
     */
    private $isbnIssn;

    /**
     * The document number of the library item.
     *
     * @var StringLiteral
     */
    private $docNumber;

    /**
     * Force the use of static methods to create LibraryItemMetadata objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a LibraryItemMetadata object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the library item info.
     *
     * @return LibraryItemMetadata
     *   A LibraryItemMetadata object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->title = StringLiteral::fromXml($xml->getElementsByTagName('title'));
        $static->author = StringLiteral::fromXml($xml->getElementsByTagName('author'));
        $static->year = StringLiteral::fromXml($xml->getElementsByTagName('year'));
        $static->imprint = StringLiteral::fromXml($xml->getElementsByTagName('imprint'));
        $static->url = Path::fromXml($xml->getElementsByTagName('docUrl'));
        $static->isbnIssn = StringLiteral::fromXml($xml->getElementsByTagName('isbn_issn'));
        $static->docNumber = StringLiteral::fromXml($xml->getElementsByTagName('docNumber'));

        return $static;
    }

    /**
     * Gets the title of the library item.
     *
     * @return StringLiteral
     *   The title of the library item.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets the author of the library item.
     *
     * @return StringLiteral
     *   The author of the library item.
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Gets the year the library item was published.
     *
     * @return StringLiteral
     *   The year the library item was published.
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Gets the library item's imprint.
     *
     * @return StringLiteral
     *   The library item's imprint.
     */
    public function getImprint()
    {
        return $this->imprint;
    }

    /**
     * Gets the path to the library item's detail page.
     *
     * @return Path
     *   The path to the library item's detail page.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the ISBN or ISSN number of the library item.
     *
     * @return StringLiteral
     *   The ISBN or ISSN number of the library item.
     */
    public function getIsbnIssn()
    {
        return $this->isbnIssn;
    }

    /**
     * Gets the document number of the library item.
     *
     * @return StringLiteral
     *   The document number of the library item.
     */
    public function getDocNumber()
    {
        return $this->docNumber;
    }

}

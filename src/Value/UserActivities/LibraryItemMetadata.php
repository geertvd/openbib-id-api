<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\StringLiteral\Path;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class LibraryItemMetadata implements ValueInterface
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
     * LibraryItemMetadata constructor.
     *
     * @param StringLiteral $title
     *   The title of the library item.
     * @param StringLiteral $author
     *   The author of the library item.
     * @param StringLiteral $year
     *   The year the library item was published.
     * @param StringLiteral $imprint
     *   The library item's imprint.
     * @param Path $url
     *   The path to the library item's detail page.
     * @param StringLiteral $isbnIssn
     *   The ISBN or ISSN number of the library item.
     * @param StringLiteral $docNumber
     *   The document number of the library item.
     */
    public function __construct(
        StringLiteral $title,
        StringLiteral $author,
        StringLiteral $year,
        StringLiteral $imprint,
        Path $url,
        StringLiteral $isbnIssn,
        StringLiteral $docNumber
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->imprint = $imprint;
        $this->url = $url;
        $this->isbnIssn = $isbnIssn;
        $this->docNumber = $docNumber;
    }

    /**
     * Builds a LibraryItemMetadata object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the library item info.
     *
     * @return LibraryItemMetadata
     *   A LibraryItemMetadata object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            StringLiteral::fromXml($xml->getElementsByTagName('title')),
            StringLiteral::fromXml($xml->getElementsByTagName('author')),
            StringLiteral::fromXml($xml->getElementsByTagName('year')),
            StringLiteral::fromXml($xml->getElementsByTagName('imprint')),
            Path::fromXml($xml->getElementsByTagName('docUrl')),
            StringLiteral::fromXml($xml->getElementsByTagName('isbn_issn')),
            StringLiteral::fromXml($xml->getElementsByTagName('docNumber'))
        );
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

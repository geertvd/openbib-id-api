<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\DateTime\DateTime;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;

class Loan extends Activity
{

    /**
     * Metadata concerning the loan item's renewable status.
     *
     * @var Renewable
     */
    private $renewable;

    /**
     * The PBS code of the library where the item was lent.
     *
     * @var StringLiteral
     */
    private $pbsCode;

    /**
     * The loan item's sequence number.
     *
     * @var StringLiteral
     */
    private $itemSequence;

    /**
     * The date when the item was lent out.
     *
     * @var DateTime
     */
    private $loanDate;

    /**
     * The date when the item is due.
     *
     * @var DateTime
     */
    private $dueDate;

    /**
     * The date when the item was returned.
     *
     * @var DateTime
     */
    private $returnedDate;

    /**
     * The type of material that was lent.
     *
     * @var StringLiteral
     */
    private $material;

    /**
     * Force the use of static methods to create Loan objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a Loan object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the loan.
     *
     * @return Loan
     *   A loan object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->libraryItemMetadata = LibraryItemMetadata::fromXml($xml);
        $static->renewable = Renewable::fromXml($xml);
        $static->pbsCode = StringLiteral::fromXml($xml->getElementsByTagName('pbsCode'));
        $static->itemSequence = StringLiteral::fromXml($xml->getElementsByTagName('itemSequence'));
        $static->loanDate = DateTime::fromXml($xml->getElementsByTagName('loanDate'));
        $static->dueDate = DateTime::fromXml($xml->getElementsByTagName('dueDate'));
        $static->returnedDate = DateTime::fromXml($xml->getElementsByTagName('returnedDate'));
        $static->material = StringLiteral::fromXml($xml->getElementsByTagName('material'));

        return $static;
    }

    /**
     * Gets the PBS code of the library where the item was lent.
     *
     * @return StringLiteral
     *   The PBS code of the library where the item was lent.
     */
    public function getPbsCode()
    {
        return $this->pbsCode;
    }

    /**
     * Gets the loan item's sequence number.
     *
     * @return StringLiteral
     *   The loan item's sequence number.
     */
    public function getItemSequence()
    {
        return $this->itemSequence;
    }

    /**
     * Gets the date when the item was lent out.
     *
     * @return DateTime
     *   The date when the item was lent out.
     */
    public function getLoanDate()
    {
        return $this->loanDate;
    }

    /**
     * Gets the date when the item is due.
     *
     * @return DateTime
     *   The date when the item is due.
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Gets the date when the item was returned.
     *
     * @return DateTime
     *   The date when the item was returned.
     */
    public function getReturnedDate()
    {
        return $this->returnedDate;
    }

    /**
     * Gets the type of material that was lent.
     *
     * @return StringLiteral
     *   The type of material that was lent.
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Gets metadata concerning the loan item's renewable status.
     *
     * @return Renewable
     *   Metadata concerning the loan item's renewable status.
     */
    public function getRenewable()
    {
        return $this->renewable;
    }
}

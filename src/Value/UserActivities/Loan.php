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
     * Creates a new Loan object.
     *
     * @param LibraryItemMetadata $libraryItemMetadata
     *   Metadata concerning the library item.
     * @param Renewable $renewable
     *   Metadata concerning the loan item's renewable status.
     * @param StringLiteral $pbsCode
     *   The PBS code of the library where the item was lent.
     * @param StringLiteral $itemSequence
     *   The loan item's sequence number.
     * @param DateTime $loanDate
     *   The date when the item was lent out.
     * @param DateTime $dueDate
     *   The date when the item is due.
     * @param DateTime $returnedDate
     *   The date when the item was returned.
     * @param StringLiteral $material
     *   The type of material that was lent.
     */
    protected function __construct(
        LibraryItemMetadata $libraryItemMetadata,
        Renewable $renewable,
        StringLiteral $pbsCode,
        StringLiteral $itemSequence,
        DateTime $loanDate,
        DateTime $dueDate,
        DateTime $returnedDate,
        StringLiteral $material
    ) {
        parent::__construct($libraryItemMetadata);
        $this->renewable = $renewable;
        $this->pbsCode = $pbsCode;
        $this->itemSequence = $itemSequence;
        $this->loanDate = $loanDate;
        $this->dueDate = $dueDate;
        $this->returnedDate = $returnedDate;
        $this->material = $material;
    }

    /**
     * Builds a Loan object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the loan.
     *
     * @return Loan
     *   A loan object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            LibraryItemMetadata::fromXml($xml),
            Renewable::fromXml($xml),
            StringLiteral::fromXml($xml->getElementsByTagName('pbsCode')),
            StringLiteral::fromXml($xml->getElementsByTagName('itemSequence')),
            DateTime::fromXml($xml->getElementsByTagName('loanDate')),
            DateTime::fromXml($xml->getElementsByTagName('dueDate')),
            DateTime::fromXml($xml->getElementsByTagName('returnedDate')),
            StringLiteral::fromXml($xml->getElementsByTagName('material'))
        );
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

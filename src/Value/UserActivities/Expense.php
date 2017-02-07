<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\DateTime\DateTime;
use OpenBibIdApi\Value\FromDomElement;
use OpenBibIdApi\Value\StringLiteral\Path;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Expense implements ValueInterface, FromDomElement
{
    /**
     * Constants describing the type of expense.
     */
    const FINE = 'FINE';
    const COST = 'COST';
    const FINE_LOAN = 'FINE_LOAN';
    const TOOLATE = 'TOOLATE';

    /**
     * The ID of the expense.
     *
     * @var StringLiteral
     */
    private $expenseId;

    /**
     * The date of the expense.
     *
     * @var DateTime
     */
    private $date;

    /**
     * The title of the expense.
     *
     * @var StringLiteral
     */
    private $title;

    /**
     * The description of the expense.
     *
     * @var StringLiteral
     */
    private $description;

    /**
     * The amount to be payed.
     *
     * @var StringLiteral
     */
    private $amount;

    /**
     * The document number of the library item of the expense.
     *
     * @var StringLiteral
     */
    private $docNumber;

    /**
     * The path to the library item of the expense.
     *
     * @var Path
     */
    private $docUrl;

    /**
     * The type of expense.
     *
     * @var StringLiteral
     */
    private $type;

    /**
     * Force the use of static methods to create Expense objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a Expense object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the expense.
     *
     * @return Expense
     *   A Expense object
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->expenseId = StringLiteral::fromXml($xml->getElementsByTagName('id'));
        $static->date = DateTime::fromXml($xml->getElementsByTagName('date'));
        $static->title = StringLiteral::fromXml($xml->getElementsByTagName('title'));
        $static->description = StringLiteral::fromXml($xml->getElementsByTagName('description'));
        $static->amount = StringLiteral::fromXml($xml->getElementsByTagName('amount'));
        $static->docNumber = StringLiteral::fromXml($xml->getElementsByTagName('docNumber'));
        $static->docUrl = Path::fromXml($xml->getElementsByTagName('docUrl'));
        $static->type = StringLiteral::fromXml($xml->getElementsByTagName('type'));

        return $static;
    }

    /**
     * Gets the ID of the expense.
     *
     * @return StringLiteral
     *    The ID of the expense.
     */
    public function getId()
    {
        return $this->expenseId;
    }

    /**
     * Gets the date of the expense.
     *
     * @return DateTime
     *   The date of the expense.
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Gets the title of the expense.
     *
     * @return StringLiteral
     *   The title of the expense.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets the description of the expense.
     *
     * @return StringLiteral
     *   The description of the expense.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the amount to be payed.
     *
     * @return StringLiteral
     *   The amount to be payed.
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Gets the document number of the library item of the expense.
     *
     * @return StringLiteral
     *   The document number of the library item of the expense.
     */
    public function getDocNumber()
    {
        return $this->docNumber;
    }

    /**
     * Gets the path to the library item of the expense.
     *
     * @return Path
     *   The path to the library item of the expense.
     */
    public function getDocUrl()
    {
        return $this->docUrl;
    }

    /**
     * Gets the type of expense.
     *
     * @return StringLiteral
     *   The type of expense.
     */
    public function getType()
    {
        return $this->type;
    }
}

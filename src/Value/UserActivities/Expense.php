<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\DateTime\DateTime;
use OpenBibIdApi\Value\Number\FloatLiteral;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;

class Expense extends Activity
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
     * @var FloatLiteral
     */
    private $amount;

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
        $static->libraryItemMetadata = LibraryItemMetadata::fromXml($xml);

        $expenseId = $xml->getElementsByTagName('id');
        $static->expenseId = StringLiteral::fromXml($expenseId);

        $date = $xml->getElementsByTagName('date');
        $static->date = DateTime::fromXml($date);

        $amount = $xml->getElementsByTagName('amount');
        $static->amount = FloatLiteral::fromXml($amount);

        $stringLiterals = array(
            'title' => $xml->getElementsByTagName('title'),
            'description' => $xml->getElementsByTagName('description'),
            'type' => $xml->getElementsByTagName('type'),
        );
        foreach ($stringLiterals as $propertyName => $xmlTag) {
            $static->$propertyName = StringLiteral::fromXml($xmlTag);
        }

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
     * @return FloatLiteral
     *   The amount to be payed.
     */
    public function getAmount()
    {
        return $this->amount;
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

<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\DateTime\DateTime;
use OpenBibIdApi\Value\StringLiteral\Path;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class Expense implements ValueInterface
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
    private $id;

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
     * Creates a new Expense.
     *
     * @param StringLiteral $id
     *   The ID of the expense.
     * @param DateTime $date
     *   The date of the expense.
     * @param StringLiteral $title
     *   The title of the expense.
     * @param StringLiteral $description
     *   The description of the expense.
     * @param StringLiteral $amount
     *   The amount to be payed.
     * @param StringLiteral $docNumber
     *   The document number of the library item of the expense.
     * @param Path $docUrl
     *   The path to the library item of the expense.
     * @param StringLiteral $type
     *   The type of expense.
     */
    public function __construct(
        StringLiteral $id,
        DateTime $date,
        StringLiteral $title,
        StringLiteral $description,
        StringLiteral $amount,
        StringLiteral $docNumber,
        Path $docUrl,
        StringLiteral $type
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->amount = $amount;
        $this->docNumber = $docNumber;
        $this->docUrl = $docUrl;
        $this->type = $type;
    }


    /**
     * Builds a Expense object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the expense.
     *
     * @return Expense
     *   A Expense object
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            StringLiteral::fromXml($xml->getElementsByTagName('id')),
            DateTime::fromXml($xml->getElementsByTagName('date')),
            StringLiteral::fromXml($xml->getElementsByTagName('title')),
            StringLiteral::fromXml($xml->getElementsByTagName('description')),
            StringLiteral::fromXml($xml->getElementsByTagName('amount')),
            StringLiteral::fromXml($xml->getElementsByTagName('docNumber')),
            Path::fromXml($xml->getElementsByTagName('docUrl')),
            StringLiteral::fromXml($xml->getElementsByTagName('type'))
        );
    }

    /**
     * Gets the ID of the expense.
     *
     * @return StringLiteral
     *    The ID of the expense.
     */
    public function getId()
    {
        return $this->id;
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

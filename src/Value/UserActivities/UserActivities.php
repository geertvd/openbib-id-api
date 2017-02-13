<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Boolean\BoolLiteral;
use OpenBibIdApi\Value\FromDomDocumentInterface;
use OpenBibIdApi\Value\Number\FloatLiteral;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class UserActivities implements ValueInterface, FromDomDocumentInterface
{
    /**
     * A collection of loan objects.
     *
     * @var LoanCollection
     */
    private $loans;

    /**
     * A historical collection of loan objects.
     *
     * @var LoanCollection
     */
    private $loanHistory;

    /**
     * A collection of hold objects.
     *
     * @var HoldCollection
     */
    private $holds;

    /**
     * A collection of expense objects.
     *
     * @var ExpenseCollection
     */
    private $expenses;

    /**
     * The total of all open fines.
     *
     * @var FloatLiteral
     */
    private $totalFine;

    /**
     * The total of all open costs.
     *
     * @var FloatLiteral
     */
    private $totalCost;

    /**
     * A message to be shown to the user.
     *
     * @var StringLiteral
     */
    private $message;

    /**
     * Determines whether the loan history can be turned on or off.
     *
     * @var BoolLiteral
     */
    private $loanHistoryConfigurable;

    /**
     * Force the use of static methods to create UserActivities objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a UserActivities object from XML.
     *
     * @param \DomDocument $xml
     *   The xml tree containing the user activities.
     *
     * @return UserActivities
     *   A UserActivities object.
     */
    public static function fromXml(\DOMDocument $xml)
    {
        $static = new static();

        $loans = $xml->getElementsByTagName('loan');
        $static->loans = LoanCollection::fromXml($loans);

        $loanHistory = $xml->getElementsByTagName('loanHistory');
        $static->loanHistory = LoanCollection::fromXml($loanHistory);

        $holds = $xml->getElementsByTagName('hold');
        $static->holds = HoldCollection::fromXml($holds);

        $expenses = $xml->getElementsByTagName('fine');
        $static->expenses = ExpenseCollection::fromXml($expenses);

        $totalFine = $xml->getElementsByTagName('totalFine');
        $static->totalFine = FloatLiteral::fromXml($totalFine);

        $totalCost = $xml->getElementsByTagName('totalCost');
        $static->totalCost = FloatLiteral::fromXml($totalCost);

        $message = $xml->getElementsByTagName('message');
        $static->message = StringLiteral::fromXml($message);

        $loanHistoryConfig = $xml->getElementsByTagName('loanHistoryConfigurable');
        $static->loanHistoryConfigurable = BoolLiteral::fromXml($loanHistoryConfig);

        return $static;
    }

    /**
     * Gets a collection of loan objects.
     *
     * @return LoanCollection|Loan[]
     *   A collection of hold objects.
     */
    public function getLoans()
    {
        return $this->loans;
    }

    /**
     * Gets a historical collection of loan objects.
     *
     * @return LoanCollection|Loan[]
     *   A historical collection of loan objects.
     */
    public function getLoanHistory()
    {
        return $this->loanHistory;
    }

    /**
     * Gets a collection of hold objects.
     *
     * @return HoldCollection|Hold[]
     *   A collection of hold objects.
     */
    public function getHolds()
    {
        return $this->holds;
    }

    /**
     * Gets a collection of expense objects.
     *
     * @return ExpenseCollection|Expense[]
     *   A collection of expense objects.
     */
    public function getExpenses()
    {
        return $this->expenses;
    }

    /**
     * Gets the total of all open fines.
     *
     * @return FloatLiteral
     *   The total of all open fines.
     */
    public function getTotalFine()
    {
        return $this->totalFine;
    }

    /**
     * Gets the total of all open costs.
     *
     * @return FloatLiteral
     *   The total of all open costs.
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * Gets a message to be shown to the user.
     *
     * @return StringLiteral
     *   A message to be shown to the user.
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Whether the loan history can be turned on or off.
     *
     * @return bool
     *   Determines whether the loan history can be turned on or off.
     */
    public function isLoanHistoryConfigurable()
    {
        return $this->loanHistoryConfigurable->isTrue();
    }
}

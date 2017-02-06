<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Boolean\BoolLiteral;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;
use OpenBibIdApi\Value\ValueInterface;

class UserActivities implements ValueInterface
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
     * @var StringLiteral
     */
    private $totalFine;

    /**
     * The total of all open expenses.
     *
     * @var StringLiteral
     */
    private $totalExpense;

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
     * Creates a new UserActivities object.
     *
     * @param LoanCollection $loans
     *   A collection of loan objects.
     * @param LoanCollection $loanHistory
     *   A historical collection of loan objects.
     * @param HoldCollection $holds
     *   A collection of hold objects.
     * @param ExpenseCollection $expenses
     *   A collection of expense objects.
     * @param StringLiteral $totalFine
     *   The total of all open fines.
     * @param StringLiteral $totalExpense
     *   The total of all open expenses.
     * @param StringLiteral $message
     *   A message to be shown to the user.
     * @param BoolLiteral $loanHistoryConfigurable
     *   Determines whether the loan history can be turned on or off.
     */
    public function __construct(
        LoanCollection $loans,
        LoanCollection $loanHistory,
        HoldCollection $holds,
        ExpenseCollection $expenses,
        StringLiteral $totalFine,
        StringLiteral $totalExpense,
        StringLiteral $message,
        BoolLiteral $loanHistoryConfigurable
    ) {
        $this->loans = $loans;
        $this->loanHistory = $loanHistory;
        $this->holds = $holds;
        $this->expenses = $expenses;
        $this->totalFine = $totalFine;
        $this->totalExpense = $totalExpense;
        $this->message = $message;
        $this->loanHistoryConfigurable = $loanHistoryConfigurable;
    }

    /**
     * Builds a UserActivities object from XML.
     *
     * @param \DomDocument
     *   The xml tree containing the user activities.
     *
     * @return UserActivities
     *   A UserActivities object.
     */
    public static function fromXml()
    {
        /* @var \DOMDocument $xml */
        $xml = func_get_arg(0);

        return new static(
            LoanCollection::fromXml($xml->getElementsByTagName('loan')),
            LoanCollection::fromXml($xml->getElementsByTagName('loanHistory')),
            HoldCollection::fromXml($xml->getElementsByTagName('hold')),
            ExpenseCollection::fromXml($xml->getElementsByTagName('fine')),
            StringLiteral::fromXml($xml->getElementsByTagName('TotalFine')),
            StringLiteral::fromXml($xml->getElementsByTagName('totalExpense')),
            StringLiteral::fromXml($xml->getElementsByTagName('message')),
            BoolLiteral::fromXml($xml->getElementsByTagName('loanHistoryConfigurable'))
        );
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
     * @return StringLiteral
     *   The total of all open fines.
     */
    public function getTotalFine()
    {
        return $this->totalFine;
    }

    /**
     * Gets the total of all open expenses.
     *
     * @return StringLiteral
     *   The total of all open expenses.
     */
    public function getTotalExpense()
    {
        return $this->totalExpense;
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
        return $this->loanHistoryConfigurable->getValue();
    }

}

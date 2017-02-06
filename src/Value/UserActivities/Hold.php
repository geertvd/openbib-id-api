<?php

namespace OpenBibIdApi\Value\UserActivities;

use OpenBibIdApi\Value\Boolean\BoolLiteral;
use OpenBibIdApi\Value\DateTime\DateTimeRange;
use OpenBibIdApi\Value\StringLiteral\StringLiteral;

class Hold extends Activity
{
    /**
     * Constants describing a hold's status.
     */
    const AVAILABLE = 'AVAILABLE';
    const QUEUED = 'QUEUED';

    /**
     * The hold item's request number.
     *
     * @var StringLiteral
     */
    private $requestNumber;

    /**
     * The hold item's sequence number.
     *
     * @var StringLiteral
     */
    private $sequence;

    /**
     * The hold item's queue position.
     *
     * @var StringLiteral
     */
    private $queuePosition;

    /**
     * The hold item's item sequence number.
     *
     * @var StringLiteral
     */
    private $itemSequence;

    /**
     * The date range range in which the hold item can be picked up.
     *
     * @var DateTimeRange
     */
    private $requestDateRange;

    /**
     * The date range range in which the hold item is reserved.
     *
     * @var DateTimeRange
     */
    private $holdDateRange;

    /**
     * The status of the reservation.
     *
     * @var StringLiteral
     */
    private $status;

    /**
     * The pickup location.
     *
     * @var PickupLocation
     */
    private $pickupLocation;

    /**
     * Whether the reservation can be cancelled.
     *
     * @var BoolLiteral
     */
    private $cancelable;

    /**
     * Creates a new Hold.
     *
     * @param LibraryItemMetadata $libraryItemMetadata
     *   Metadata concerning the library item.
     * @param StringLiteral $requestNumber
     *   The hold item's request number.
     * @param StringLiteral $sequence
     *   The hold item's sequence number.
     * @param StringLiteral $queuePosition
     *   The hold item's queue position.
     * @param StringLiteral $itemSequence
     *   The hold item's item sequence number.
     * @param DateTimeRange $requestDateRange
     *   The date range range in which the hold item can be picked up.
     * @param DateTimeRange $holdDateRange
     *   The date range range in which the hold item is reserved.
     * @param StringLiteral $status
     *   The status of the reservation.
     * @param PickupLocation $pickupLocation
     *   The pickup location.
     * @param BoolLiteral $cancelable
     *   Whether the reservation can be cancelled.
     */
    public function __construct(
        LibraryItemMetadata $libraryItemMetadata,
        StringLiteral $requestNumber,
        StringLiteral $sequence,
        StringLiteral $queuePosition,
        StringLiteral $itemSequence,
        DateTimeRange $requestDateRange,
        DateTimeRange $holdDateRange,
        StringLiteral $status,
        PickupLocation $pickupLocation,
        BoolLiteral $cancelable
    ) {
        parent::__construct($libraryItemMetadata);
        $this->requestNumber = $requestNumber;
        $this->sequence = $sequence;
        $this->queuePosition = $queuePosition;
        $this->itemSequence = $itemSequence;
        $this->requestDateRange = $requestDateRange;
        $this->holdDateRange = $holdDateRange;
        $this->status = $status;
        $this->pickupLocation = $pickupLocation;
        $this->cancelable = $cancelable;
    }

    /**
     * Builds a Hold object from XML.
     *
     * @param \DOMElement
     *   The xml element containing the hold.
     *
     * @return Hold
     *   A Hold object.
     */
    public static function fromXml()
    {
        /* @var \DOMElement $xml */
        $xml = func_get_arg(0);

        return new static(
            LibraryItemMetadata::fromXml($xml),
            StringLiteral::fromXml($xml->getElementsByTagName('requestNumber')),
            StringLiteral::fromXml($xml->getElementsByTagName('sequence')),
            StringLiteral::fromXml($xml->getElementsByTagName('queuePosition')),
            StringLiteral::fromXml($xml->getElementsByTagName('itemSequence')),
            DateTimeRange::fromXml($xml->getElementsByTagName('requestDate'),
                $xml->getElementsByTagName('endRequestDate')),
            DateTimeRange::fromXml($xml->getElementsByTagName('holdDate'),
                $xml->getElementsByTagName('endHoldDate')),
            StringLiteral::fromXml($xml->getElementsByTagName('status')),
            PickupLocation::fromXml($xml),
            BoolLiteral::fromXml($xml->getElementsByTagName('cancelable'))
        );
    }

    /**
     * Gets the hold item's request number.
     *
     * @return StringLiteral
     *   The hold item's request number.
     */
    public function getRequestNumber()
    {
        return $this->requestNumber;
    }

    /**
     * Gets the hold item's sequence number.
     *
     * @return StringLiteral
     *   The hold item's sequence number.
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Gets the hold item's queue position.
     *
     * @return StringLiteral
     *   The hold item's queue position.
     */
    public function getQueuePosition()
    {
        return $this->queuePosition;
    }

    /**
     * Gets the hold item's item sequence number.
     *
     * @return StringLiteral
     *   The hold item's item sequence number.
     */
    public function getItemSequence()
    {
        return $this->itemSequence;
    }

    /**
     * Gets the date range range in which the hold item can be picked up.
     *
     * @return DateTimeRange
     *   The date range range in which the hold item can be picked up.
     */
    public function getRequestDateRange()
    {
        return $this->requestDateRange;
    }

    /**
     * Gets the date range range in which the hold item is reserved.
     *
     * @return DateTimeRange
     *   The date range range in which the hold item is reserved.
     */
    public function getHoldDateRange()
    {
        return $this->holdDateRange;
    }

    /**
     * Gets the status of the reservation.
     *
     * @return StringLiteral
     *   The status of the reservation.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets the pickup location.
     *
     * @return PickupLocation
     *   The pickup location.
     */
    public function getPickupLocation()
    {
        return $this->pickupLocation;
    }

    /**
     * Checks whether the reservation can be cancelled.
     *
     * @return bool
     *   Whether the reservation can be cancelled.
     */
    public function isCancelable()
    {
        return $this->cancelable->getValue();
    }

}

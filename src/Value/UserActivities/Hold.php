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
     * Force the use of static methods to create Hold objects.
     */
    private function __construct()
    {
    }

    /**
     * Builds a Hold object from XML.
     *
     * @param \DOMElement $xml
     *   The xml element containing the hold.
     *
     * @return Hold
     *   A Hold object.
     */
    public static function fromXml(\DOMElement $xml)
    {
        $static = new static();
        $static->libraryItemMetadata = LibraryItemMetadata::fromXml($xml);
        $static->requestNumber = StringLiteral::fromXml($xml->getElementsByTagName('requestNumber'));
        $static->sequence = StringLiteral::fromXml($xml->getElementsByTagName('sequence'));
        $static->queuePosition = StringLiteral::fromXml($xml->getElementsByTagName('queuePosition'));
        $static->itemSequence = StringLiteral::fromXml($xml->getElementsByTagName('itemSequence'));
        $static->requestDateRange = DateTimeRange::fromXml($xml->getElementsByTagName('requestDate'),
            $xml->getElementsByTagName('endRequestDate'));
        $static->holdDateRange = DateTimeRange::fromXml($xml->getElementsByTagName('holdDate'),
            $xml->getElementsByTagName('endHoldDate'));
        $static->status = StringLiteral::fromXml($xml->getElementsByTagName('status'));
        $static->pickupLocation = PickupLocation::fromXml($xml);
        $static->cancelable = BoolLiteral::fromXml($xml->getElementsByTagName('cancelable'));
        return $static;
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

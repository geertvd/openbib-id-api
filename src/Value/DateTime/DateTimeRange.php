<?php

namespace OpenBibIdApi\Value\DateTime;

use OpenBibIdApi\Value\ValueInterface;

class DateTimeRange implements ValueInterface
{
    /**
     * The start date.
     *
     * @var DateTime
     */
    private $start;

    /**
     * The end date.
     *
     * @var DateTime
     */
    private $end;

    /**
     * Creates a new DateTimeRange.
     *
     * @param DateTime $start
     *   The start date.
     * @param DateTime $end
     *   The end date.
     */
    private function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Builds a DateTimeRange object from XML.
     *
     * @param \DOMNodeList $start
     *   The xml tag containing the start date.
     * @param \DOMNodeList $end
     *   The xml tag containing the end date.
     *
     * @return DateTimeRange
     *   The DateTimeRange object.
     */
    public static function fromXml($start, $end)
    {
        return new static(
            DateTime::fromXml($start),
            DateTime::fromXml($end)
        );
    }

    /**
     * @return DateTime
     *   The start date.
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return DateTime
     *   The end date.
     */
    public function getEnd()
    {
        return $this->end;
    }
}

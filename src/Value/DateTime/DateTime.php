<?php

namespace OpenBibIdApi\Value\DateTime;

use OpenBibIdApi\Value\FromDomNodeListInterface;
use OpenBibIdApi\Value\ValueInterface;

class DateTime implements ValueInterface, FromDomNodeListInterface
{
    /**
     * The DateTimeImmutable object.
     *
     * @var \DateTimeImmutable
     */
    private $value;

    /**
     * Creates a new DateTime.
     *
     * @param \DateTimeImmutable $value
     *   The DateTimeImmutable object.
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Builds a DateTime object from XML.
     *
     * @param \DOMNodeList $xml
     *   The xml tag containing the date.
     *
     * @return DateTime
     *   A DateTime object.
     */
    public static function fromXml(\DOMNodeList $xml)
    {
        $value = null;
        if ($xml->length > 0) {
            $value = new \DateTimeImmutable($xml->item(0)->textContent);
        }
        return new static($value);
    }

    /**
     * Gets the DateTimeImmutable object.
     *
     * @return \DateTimeImmutable
     *   The DateTimeImmutable object.
     */
    public function getDateTime()
    {
        return $this->value;
    }

    /**
     * Whether the set date has past today's date.
     *
     * @return bool
     *   True if the date has past today, false if not.
     */
    public function hasPastToday()
    {
        return new \DateTimeImmutable() > $this->getDateTime();
    }
}

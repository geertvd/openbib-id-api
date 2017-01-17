<?php

namespace OpenBibIdApi\Service;

use OpenBibIdApi\Consumer\BibConsumerInterface;

abstract class Service implements ServiceInterface
{

    /**
     * The consumer.
     *
     * @var \OpenBibIdApi\Consumer\BibConsumerInterface
     */
    protected $consumer;

    /**
     * Creates a new service.
     *
     * @param BibConsumerInterface $consumer
     *   The consumer.
     */
    public function __construct(BibConsumerInterface $consumer)
    {
        $this->consumer = $consumer;
    }
}

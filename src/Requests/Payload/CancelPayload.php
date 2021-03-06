<?php

declare(strict_types=1);

namespace BankID\SDK\Requests\Payload;

use BankID\SDK\Annotations;
use BankID\SDK\Requests\Payload\Interfaces\PayloadInterface;

/**
 * Class CancelPayload
 *
 * @package BankID\SDK\Requests\Payloads
 */
class CancelPayload implements PayloadInterface
{
    /**
     * The orderRef from the response from @code authentication or @code sign.
     *
     * @Annotations\Parameter("orderRef")
     *
     * @var string
     */
    protected $orderRef;

    /**
     * CancelPayload constructor.
     *
     * @param string $orderRef
     */
    public function __construct(string $orderRef)
    {
        $this->orderRef = $orderRef;
    }

    /**
     * Returns the order reference.
     *
     * @return string
     */
    public function getOrderRef(): string
    {
        return $this->orderRef;
    }
}

<?php

namespace BankID\SDK\Responses\DTO;

/**
 * Class Collect
 *
 * @package BankID\SDK\Responses\DTO
 */
class Collect extends Envelope
{

    /**
     * The order is pending. The client has not yet received the order.
     * The hintCode will later change to noClient,started or userSign.
     */
    public const HINT_CODE_OUTSTANDING_TRANSACTION = 'outstandingTransaction';

    /**
     * The order is pending. The client has not yet received the order.
     */
    public const HINT_CODE_NO_CLIENT = 'noClient';

    /**
     * The order is pending. A Client has started with the @code autostarttoken but a usable ID has
     * not yet been found in the started client.
     * When the client start the may be a short delay until all ID:s are registered.
     * The user may not have any usable ID:s at all, or has not yet inserted their smart card.
     */
    public const HINT_CODE_STARTED = 'started';

    /**
     * The order is pending. The client has received the order.
     */
    public const HINT_USER_SIGN = 'userSign';

    /**
     * The order has expired. The BankID security app/program did not start,
     * the user did not finalize the signing or the RP called collect to late.
     */
    public const HINT_EXPIRED_TRANSACTION = 'expiredTransaction';

    /**
     * The error is returned if:
     * 1. The user has entered wrong security code too many times. The BankID cannot be used.
     * 2. The users BankID is revoked.
     * 3. The users BankID is invalid.
     */
    public const HINT_CERTIFICATE_ERROR = 'certificateErr';

    /**
     * The user decided to cancel the order.
     */
    public const HINT_USER_CANCEL = 'userCancel';

    /**
     * The order was cancelled. The system received a new order for the user.
     */
    public const HINT_CANCELLED = 'cancelled';

    /**
     * The user did not provide here ID, or the RP requires autoStartToken to
     * be used, but the client did not start within a certain time limit. The
     * reason may be:
     * 1. RP did not use autoStartToken when starting BankID security
     *    program/app. RP must correct this in their implementation.
     * 2. The client software was not installed, or other problem with the users
     *    computer.
     */
    public const START_FAILED = 'startFailed';

    /**
     * The @code orderRef in question.
     *
     * @var string
     */
    protected $orderRef;

    /**
     * The order is being processed.
     *
     * @var string
     */
    protected $status;

    /**
     * Only present for pending and failed orders.
     *
     * @var string|null
     */
    protected $hintCode;

    /**
     * Only present for complete orders.
     *
     * @var CompletionData
     */
    protected $completionData;

    /**
     * @return string
     */
    public function getOrderRef(): string
    {
        return $this->orderRef;
    }

    /**
     * @param string $orderRef
     * @return static
     */
    public function setOrderRef(string $orderRef)
    {
        $this->orderRef = $orderRef;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return static
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHintCode(): ?string
    {
        return $this->hintCode;
    }

    /**
     * @param string|null $hintCode
     * @return static
     */
    public function setHintCode(?string $hintCode)
    {
        $this->hintCode = $hintCode;
        return $this;
    }

    /**
     * @return CompletionData|null
     */
    public function getCompletionData(): ?CompletionData
    {
        return $this->completionData;
    }

    /**
     * @param CompletionData|null $completionData
     * @return static
     */
    public function setCompletionData(?CompletionData $completionData)
    {
        $this->completionData = $completionData;
        return $this;
    }
}

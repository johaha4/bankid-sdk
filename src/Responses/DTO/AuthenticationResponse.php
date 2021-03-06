<?php

declare(strict_types=1);

namespace BankID\SDK\Responses\DTO;

use BankID\SDK\ClientAsynchronous;
use BankID\SDK\Requests\Payload\CancelPayload;
use BankID\SDK\Requests\Payload\CollectPayload;
use Exception;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class AuthenticationResponse
 *
 * @package BankID\SDK\Responses\DTO
 */
class AuthenticationResponse extends Envelope
{

    /**
     * @SerializedName("orderRef")
     * @var string|null
     */
    protected $orderRef;

    /**
     * @SerializedName("autoStartToken")
     * @var string|null
     */
    protected $autoStartToken;

    /**
     * @var ClientAsynchronous
     */
    protected $client;

    /**
     * AuthenticationResponse constructor.
     *
     * @param ClientAsynchronous $client
     */
    public function __construct(ClientAsynchronous $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the order reference.
     *
     * @return string|null
     */
    public function getOrderRef(): ?string
    {
        return $this->orderRef;
    }

    /**
     * Returns the auto start token.
     *
     * @return string|null
     */
    public function getAutoStartToken(): ?string
    {
        return $this->autoStartToken;
    }

    /**
     * Collects the result of a sign or auth order using the orderRef as reference.
     *
     * @return CollectResponse
     * @throws Exception
     */
    public function collect(): CollectResponse
    {
        if (!$this->isSuccess()) {
            throw new Exception(\sprintf(
                'Action not possible. Possible cause: %s',
                $this->getDetails()
            ));
        }

        return $this->client->collect(new CollectPayload($this->orderRef))->wait(true);
    }

    /**
     * Cancels an ongoing sign or auth order.
     *
     * @return CancelResponse
     * @throws Exception
     */
    public function cancel(): CancelResponse
    {
        if (!$this->isSuccess()) {
            throw new \Exception(\sprintf(
                'Action not possible. Possible cause: %s',
                $this->getDetails()
            ));
        }

        return $this->client->cancel(new CancelPayload($this->orderRef))->wait(true);
    }
}

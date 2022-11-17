<?php

namespace App\Exceptions;

use Throwable;
use RuntimeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;

/**
 * Customizable json resposne error status and body when raising exception
 *
 * For errors don't need to be collect by error management service
 * @see \TruTrip\Core\Exceptions\RejectClientException
 */
class ApiException extends RuntimeException implements Responsable
{
    private $responseBody;
    private $status;

    public function __construct(int $status, string $message, $responseBody = null, int $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);

        $responseBody['message'] = $responseBody['message'] ?? $message;

        $this->responseBody = $responseBody;
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return new JsonResponse($this->responseBody, $this->status);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getContext()
    {
        return $this->responseBody;
    }
}

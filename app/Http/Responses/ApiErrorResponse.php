<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final class ApiErrorResponse implements Responsable
{
    public function __construct(
        private string $message,
        private int $statusCode,
        private \Throwable $exception,
        private array $headers = [],
        private int $options = 0
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        $response = ["message" => $this->message];

        if (!is_null($this->exception) && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->exception->getMessage(),
                'file'    => $this->exception->getFile(),
                'line'    => $this->exception->getLine(),
                'trace'   => $this->exception->getTraceAsString()
            ];
        }

        return response()->json(
            $response,
            $this->statusCode,
            $this->headers,
            $this->options
        );
    }
}

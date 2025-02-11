<?php

namespace App\Traits;

use Illuminate\Http\Response;
use App\Http\Responses\ApiErrorResponse;

trait ApiResponseWithError
{
    protected function getApiErrorResponse(\Throwable $exception): ApiErrorResponse
    {
        $statusCode = $exception->getCode();

        if (!is_int($statusCode) || $statusCode < 100 || $statusCode > 599) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return new ApiErrorResponse(
            exception: $exception,
            message: $exception->getMessage(),
            statusCode: $statusCode,
        );
    }

}

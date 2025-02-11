<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ApiSuccessResponse  implements Responsable
{
    public function __construct(
        private mixed $data = [],
        private array $metadata = [],
        private int $code = Response::HTTP_OK,
        private array $headers = []
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        if ($this->data instanceof Paginator) {

            $current_metadata = [
                'current_page' => $this->data->currentPage(),
                'per_page' => $this->data->perPage(),
                'from' => $this->data->firstItem(),
                'to' => $this->data->lastItem(),
                'path' => $this->data->path(),
                'first_page_url' => $this->data->url(1),
                'next_page_url' => $this->data->nextPageUrl(),
                'prev_page_url' => $this->data->previousPageUrl(),
            ];

            isset($this->metadata) ? $current_metadata = array_merge($current_metadata, $this->metadata) : null;

            return response()->json(
                [
                    'data' => $this->data->items(),
                    'metadata' => $current_metadata,
                ],
                $this->code,
                $this->headers
            );
        }

        return response()->json(
            [
                'data' => $this->data,
                'metadata' => $this->metadata,
            ],
            $this->code,
            $this->headers
        );
    }
}

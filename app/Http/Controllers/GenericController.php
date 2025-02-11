<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiSuccessResponse;
use App\Services\GenericService;
use App\Traits\ApiResponseWithError;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenericController extends Controller
{
    use ApiResponseWithError;

    public function __construct(
        private GenericService $service,
    ) {}

    public function store(Request $request)
    {
        try {
            return new ApiSuccessResponse(
                data: $this->service->create($request->toArray()),
                code: Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return $this->getApiErrorResponse($th);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return new ApiSuccessResponse(
                data: $this->service->update(
                    id: $id,
                    data: $request->toArray()
                ),
            );
        } catch (\Throwable $th) {
            return $this->getApiErrorResponse($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->service->delete($id);

            return new ApiSuccessResponse(
                metadata: ['message' => 'Resource deleted successfully'],
                code: Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->getApiErrorResponse($th);
        }
    }
}

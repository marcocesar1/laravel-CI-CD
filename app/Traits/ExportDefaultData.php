<?php

namespace App\Traits;

use App\Http\Responses\ApiSuccessResponse;
use App\Services\DataExport\Strategies\PdfExportStrategy;
use App\Services\DataExport\Strategies\XlsxExportStrategy;

trait ExportDefaultData
{
    public function exportPdf()
    {
        try {
            $this->exportService = $this->buildExportService(
                strategy: new PdfExportStrategy(),
                query: $this->service->getQuery(
                    $this->request->all(),
                    $this->selectedFields
                )
            );

            return new ApiSuccessResponse(
                data: [
                    'url' => $this->exportService->export()
                ]
            );
        } catch (\Throwable $th) {
            return $this->getApiErrorResponse($th);
        }
    }

    public function exportExcel()
    {
        try {
            $this->exportService = $this->buildExportService(
                strategy: new XlsxExportStrategy(),
                query: $this->service->getQuery(
                    $this->request->all(),
                    $this->selectedFields
                )
            );

            return new ApiSuccessResponse(
                data: [
                    'url' => $this->exportService->export()
                ]
            );
        } catch (\Throwable $th) {
            return $this->getApiErrorResponse($th);
        }
    }
}

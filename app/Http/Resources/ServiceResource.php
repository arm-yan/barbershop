<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use LogicException;

class ServiceResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        if (!$this->resource instanceof Service) {
            throw new LogicException('Invalid resource usage');
        }

        return $this->resource->toArray();
    }
}

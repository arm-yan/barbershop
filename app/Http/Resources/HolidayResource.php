<?php

namespace App\Http\Resources;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use LogicException;

class HolidayResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        if (!$this->resource instanceof Holiday) {
            throw new LogicException('Invalid resource usage');
        }
        return [
            'title' => $this->resource->title,
            'date' => Carbon::create($this->resource->date)->format('Y-m-d'),
        ];
    }
}

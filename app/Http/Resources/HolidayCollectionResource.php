<?php

namespace App\Http\Resources;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HolidayCollectionResource extends ResourceCollection
{
    public static $wrap = false;

    /**
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $result = [];

        /** @var Holiday $item */
        foreach ($this->collection as $item) {
            $result[] = new HolidayResource($item);
        }

        return $result;
    }
}

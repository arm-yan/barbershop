<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServicesCollectionResource extends ResourceCollection
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

        /** @var Service $item */
        foreach ($this->collection as $item) {
            $result[] = new ServiceResource($item);
        }

        return $result;
    }
}

<?php

namespace App\Pharmacy\Resource;

use Hyperf\Resource\Json\JsonResource;

class DictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}

<?php

namespace App\Pharmacy\Collection;

use Hyperf\Resource\Json\ResourceCollection;

class DrugCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}

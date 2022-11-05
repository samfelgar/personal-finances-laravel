<?php

namespace App\Http\Resources;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        if ($this->resource === null) {
            return [];
        }

        /** @var Record $record */
        $record = $this->resource;

        return [
            'id' => $record->id,
            'description' => $record->description,
            'type' => $record->type,
            'amount' => $record->amount,
            'reference' => $record->reference,
            'paid' => $record->paid,
            'created_at' => $record->created_at,
            'updated_at' => $record->updated_at,
        ];
    }
}

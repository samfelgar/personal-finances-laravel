<?php

namespace App\Services\Records;

use App\Models\Record;
use App\Services\Records\DTO\StoreRecordDto;
use Carbon\Carbon;

class StoreRecord
{
    public function execute(StoreRecordDto $recordDto): Record
    {
        $record = new Record();
        $record->description = $recordDto->description;
        $record->type = $recordDto->type;
        $record->amount = $recordDto->amount;
        $record->reference = Carbon::instance($recordDto->reference);
        $record->paid = $recordDto->paid;

        $record->save();

        return $record;
    }
}

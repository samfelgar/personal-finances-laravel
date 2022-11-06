<?php

namespace App\Services\Records;

use App\Models\Record;
use App\Services\Records\DTO\StoreRecordDto;

class UpdateRecord
{
    public function execute(Record $record, StoreRecordDto $recordDto): Record
    {
        $record->description = $recordDto->description;
        $record->type = $recordDto->type;
        $record->amount = $recordDto->amount;
        $record->reference = $recordDto->reference;
        $record->paid = $recordDto->paid;

        $record->save();

        return $record;
    }

    public function updatePaymentInfo(Record $record, bool $paid): Record
    {
        $record->paid = $paid;
        $record->save();
        return $record;
    }
}

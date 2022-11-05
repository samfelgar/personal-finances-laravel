<?php

namespace App\Services\Records;

use App\Models\Record;
use DateTimeImmutable;
use Illuminate\Support\Collection;

class GetByPeriod
{
    public function execute(DateTimeImmutable $startDate, DateTimeImmutable $endDate): Collection
    {
        return Record::query()
            ->where('reference', '>=', $startDate)
            ->where('reference', '<=', $endDate)
            ->get();
    }
}

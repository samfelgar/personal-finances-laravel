<?php

namespace App\Services\Records\DTO;

use App\Models\RecordType;
use DateTimeImmutable;

final class StoreRecordDto
{
    public function __construct(
        public readonly string $description,
        public readonly RecordType $type,
        public readonly float $amount,
        public readonly DateTimeImmutable $reference,
        public readonly bool $paid,
    ) {
    }
}

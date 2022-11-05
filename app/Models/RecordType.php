<?php

namespace App\Models;

enum RecordType: string
{
    case Revenue = 'revenue';
    case Debt = 'debt';

    public static function values(): array
    {
        $cases = self::cases();
        return array_map(fn (RecordType $recordType) => $recordType->value, $cases);
    }
}

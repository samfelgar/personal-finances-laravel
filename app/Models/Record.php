<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $description
 * @property RecordType $type
 * @property float $amount
 * @property Carbon $reference
 * @property bool $paid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description',
        'type',
        'amount',
        'reference',
        'paid',
    ];

    protected $casts = [
        'type' => RecordType::class,
        'reference' => 'datetime',
        'paid' => 'boolean',
    ];
}

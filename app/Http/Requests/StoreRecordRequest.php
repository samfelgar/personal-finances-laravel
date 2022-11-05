<?php

namespace App\Http\Requests;

use App\Models\RecordType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required'],
            'type' => ['required', Rule::in(RecordType::values())],
            'amount' => ['required', 'numeric'],
            'reference' => ['required', 'date_format:Y-m-d'],
            'paid' => ['required', 'boolean'],
        ];
    }
}

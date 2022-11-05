<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordsByPeriodRequest;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use App\Models\RecordType;
use App\Services\Records\DTO\StoreRecordDto;
use App\Services\Records\GetByPeriod;
use App\Services\Records\StoreRecord;
use App\Services\Records\UpdateRecord;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RecordController extends Controller
{
    public function index(RecordsByPeriodRequest $request, GetByPeriod $getByPeriod): AnonymousResourceCollection
    {
        $startDate = $request->query('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->query('end_date', now()->endOfMonth()->format('Y-m-d'));

        $startDate = (new Carbon($startDate))->startOfDay();
        $endDate = (new Carbon($endDate))->endOfDay();

        $records = $getByPeriod->execute($startDate->toDateTimeImmutable(), $endDate->toDateTimeImmutable());

        return RecordResource::collection($records);
    }

    public function store(StoreRecordRequest $request, StoreRecord $storeRecord): RecordResource
    {
        $recordDto = $this->payloadToStoreDto($request);
        $record = $storeRecord->execute($recordDto);

        return new RecordResource($record);
    }

    private function payloadToStoreDto(StoreRecordRequest $request): StoreRecordDto
    {
        $payload = $request->validated();

        return new StoreRecordDto(
            $payload['description'],
            RecordType::from($payload['type']),
            (float) $payload['amount'],
            new DateTimeImmutable($payload['reference']),
            (bool) $payload['paid']
        );
    }

    public function show(Record $record): RecordResource
    {
        return new RecordResource($record);
    }

    public function update(StoreRecordRequest $request, UpdateRecord $updateRecord, Record $record): RecordResource
    {
        $recordDto = $this->payloadToStoreDto($request);
        $record = $updateRecord->execute($record, $recordDto);

        return new RecordResource($record);
    }

    public function destroy(Record $record): Response
    {
        $record->delete();
        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Record\CreateRecordRequest;
use Illuminate\Http\Request;
use App\Services\RecordService;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * RecordController class
 * @author Kenneth Sumang
 */
class RecordController extends Controller
{
    /** @var RecordService */
    private RecordService $recordService;

    /**
     * Constructor.
     * @param RecordService $recordService
     */
    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;   
    }

    /**
     * Create Record
     * @param CreateRecordRequest $request
     * @return JsonResource
     */
    final public function createRecord(CreateRecordRequest $oRequest) : JsonResource
    {
        $aData = $oRequest->validated();
        return $this->recordService->createRecord($aData);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecordService;

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
}

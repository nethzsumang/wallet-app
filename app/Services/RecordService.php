<?php
namespace App\Services;

use App\Http\Resources\Record\RecordResource;
use App\Repositories\RecordRepository;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * RecordService class
 * @author Kenneth Sumang
 */
class RecordService extends BaseService
{
    /** @var RecordRepository */
    private RecordRepository $recordTypeRepository;

    /**
     * Constructor.
     * @param RecordRepository $recordRepository
     */
    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    /**
     * Creates a new record
     * @param array $aData
     * @return JsonResource
     */
    final public function createRecord(array $aData) : JsonResource
    {
        return new RecordResource([]);
    }
}
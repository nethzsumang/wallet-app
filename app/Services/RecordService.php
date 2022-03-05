<?php
namespace App\Services;

use App\Repositories\RecordRepository;

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
}
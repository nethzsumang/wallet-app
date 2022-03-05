<?php
namespace App\Services;

use App\Repositories\RecordTypeRepository;

/**
 * RecordTypeService class
 * @author Kenneth Sumang
 */
class RecordTypeService extends BaseService
{
    /** @var RecordTypeRepository */
    private RecordTypeRepository $recordTypeRepository;

    /**
     * Constructor.
     * @param RecordTypeRepository $recordTypeRepository
     */
    public function __construct(RecordTypeRepository $recordTypeRepository)
    {
        $this->recordTypeRepository = $recordTypeRepository;
    }
}
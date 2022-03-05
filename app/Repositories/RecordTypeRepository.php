<?php
namespace App\Repositories;

use App\Models\RecordType;

/**
 * RecordTypeRepository class
 * @author Kenneth Sumang
 */
class RecordTypeRepository extends BaseRepository
{
    /**
     * Constructor
     * @param RecordType $recordType
     */
    public function __construct(RecordType $recordType)
    {
        parent::__construct($recordType);
    }
}
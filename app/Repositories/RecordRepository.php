<?php
namespace App\Repositories;

use App\Models\Record;

/**
 * RecordRepository class
 * @author Kenneth Sumang
 */
class RecordRepository extends BaseRepository
{
    /**
     * Constructor
     * @param Record $record
     */
    public function __construct(Record $record)
    {
        parent::__construct($record);
    }
}
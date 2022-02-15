<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountSummary extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Account relationship
     * @return BelongsTo
     */
    public function account() : BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}

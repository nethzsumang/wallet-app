<?php

namespace App\Models;

use App\Models\Traits\GetRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory, GetRelationships;

    protected $guarded = [];

    /**
     * User relationship
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Account summary relationship
     * @return HasMany
     */
    public function accountSummaries() : HasMany
    {
        return $this->hasMany(AccountSummary::class, 'account_id', 'id');
    }

    /**
     * Gets the latest account summary in relationship
     * @return HasMany
     */
    public function latestAccountSummary() : HasMany
    {
        return $this->hasMany(AccountSummary::class, 'account_id', 'id')->latest();
    }
}

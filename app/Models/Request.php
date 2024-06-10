<?php

namespace App\Models;

use App\Models\Scopes\RequestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Request extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
        'user_id',
        'service_id',
        'stripe_payment_id',
        'title',
        'description',
        'content',
        'solution',
        'amount_due',
        'paid_at',
        'completed_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new RequestScope);
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
        // Customize the data array...
        return $array;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

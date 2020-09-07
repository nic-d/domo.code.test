<?php

namespace App\Domain\Chat\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Infrastructure\Support\Traits\Uuid;

/**
 * @property-read int $id
 * @property-read string $uuid
 * @property int $user_id
 * @property int $channel_id
 * @property string $message
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 */
class Message extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $fillable = [
//        'id',
//        'uuid',
        'user_id',
        'channel_id',
        'message',
//        'created_at',
//        'updated_at',
//        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return Relations\BelongsTo
     */
    public function user() : Relations\BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id',
        );
    }

    /**
     * @return Relations\BelongsTo
     */
    public function channel() : Relations\BelongsTo
    {
        return $this->belongsTo(
            Channel::class,
            'channel_id',
            'id',
        );
    }

    /**
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'uuid';
    }
}

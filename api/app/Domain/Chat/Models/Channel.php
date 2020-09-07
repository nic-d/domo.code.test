<?php

namespace App\Domain\Chat\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Infrastructure\Support\Traits\Uuid;

/**
 * @property-read int $id
 * @property-read string $uuid
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $last_message_at
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 */
class Channel extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $fillable = [
//        'id',
//        'uuid',
        'name',
        'description',
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
     * @return Carbon|null
     */
    public function getLastMessageAtAttribute() : ?Carbon
    {
        if ($this->messages()->count() <= 0) {
            return null;
        }

        $message = $this
            ->messages()
            ->orderByDesc('created_at')
            ->first()
        ;

        if (! $message instanceof Message) {
            return null;
        }

        return $message->created_at;
    }

    /**
     * @return Relations\HasMany
     */
    public function messages() : Relations\HasMany
    {
        return $this->hasMany(
            Message::class,
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

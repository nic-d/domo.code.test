<?php

namespace App\Domain\Infrastructure\Models;

use Carbon\Carbon;
use Laravolt\Avatar\Avatar;
use Laravel\Passport\HasApiTokens;
use App\Domain\Chat\Models\Message;
use App\Domain\Chat\Models\Channel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Infrastructure\Support\Traits\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property-read int $id
 * @property-read string $uuid
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $channel_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * -- attributes --
 * @property-read string $avatar
 * @property-read string|null $last_active_channel
 */
class User extends Authenticatable
{
    use Uuid;
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    protected $fillable = [
//        'id',
//        'uuid',
        'name',
        'email',
        'password',
        'channel_id'
//        'created_at',
//        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return string
     */
    public function getAvatarAttribute() : string
    {
        return (new Avatar([]))->create($this->name)->toBase64();
    }

    /**
     * @return string|null
     */
    public function getLastActiveChannelAttribute() : ?string
    {
        if ($this->channel instanceof Channel) {
            return $this->channel->uuid;
        }

        // If no channel set, let's return the first one
        return Channel::all()->first()->uuid;
    }

    /**
     * @return Relations\HasMany
     */
    public function messages() : Relations\HasMany
    {
        return $this->hasMany(
            Message::class,
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

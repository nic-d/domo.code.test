<?php

namespace App\Domain\Infrastructure\Models;

use Carbon\Carbon;
use Laravolt\Avatar\Avatar;
use Laravel\Passport\HasApiTokens;
use App\Domain\Chat\Models\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Infrastructure\Support\Traits\Uuid;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $is_online
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * -- attributes --
 * @property-read string $avatar
 * @property-read string $last_subjectable_type
 * @property-read string $last_subjectable_uuid
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
        'is_online',
        'subjectable_id',
        'subjectable_type',
//        'created_at',
//        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_online' => 'boolean',
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
    public function getLastSubjectableTypeAttribute() : ?string
    {
        if ($this->subjectable === null) {
            return null;
        }

        return strtolower(class_basename($this->subjectable_type));
    }

    /**
     * @return string|null
     */
    public function getLastSubjectableUuidAttribute() : ?string
    {
        if ($this->subjectable === null) {
            return null;
        }

        return $this->subjectable->uuid;
    }

    /**
     * @return Relations\MorphTo
     */
    public function subjectable() : Relations\MorphTo
    {
        return $this->morphTo('subjectable');
    }

    /**
     * @return MorphMany
     */
    public function messages() : MorphMany
    {
        return $this->morphMany(
            Message::class,
            'subjectable',
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

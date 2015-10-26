<?php

namespace AC\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * AC\Models\User
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereUsername($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|Mirror[] $mirrors
 * @property-read \Illuminate\Database\Eloquent\Collection|MirrorReport[] $mirrorReports
 * @property-read \Illuminate\Database\Eloquent\Collection|Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|Vote[] $votes
 * @property boolean $active
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\User whereActive($value)
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'             => 'int',
        'username'       => 'string',
        'email'          => 'string',
        'password'       => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Get images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
    }

    /**
     * Get mirrors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrors()
    {
        return $this->hasMany(Mirror::class, 'user_id', 'id');
    }

    /**
     * Get mirror reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrorReports()
    {
        return $this->hasMany(MirrorReport::class, 'user_id', 'id');
    }

    /**
     * Get roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'role_id', 'user_id');
    }

    /**
     * Get votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }
}

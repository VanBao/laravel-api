<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone', 'avatar', 'group_id', 'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function created_pages()
    {
        return $this->hasMany(Page::class, 'created_id', 'id');
    }

    public function updated_pages()
    {
        return $this->hasMany(Page::class, 'updated_id', 'id');
    }

    public function created_category()
    {
        return $this->hasMany(Category::class, 'created_id', 'id');
    }

    public function updated_category()
    {
        return $this->hasMany(Category::class, 'updated_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'created_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'uid', 'id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_uid', 'uid', 'notification_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'uid', 'id');
    }

    public function booked()
    {
        return $this->hasMany(Booking::class, 'staff_id', 'id');
    }

    public function request_supports()
    {
        return $this->hasMany(RequestSupport::class, 'uid', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function user_setting()
    {
        return $this->hasMany(UserSetting::class, 'uid', 'id');
    }

    public function booking_rating()
    {
        return $this->hasMany(BookingRating::class, 'uid', 'id');
    }

    public function message_from()
    {
        return $this->hasMany(Message::class, 'from', 'id');
    }

    public function message_to()
    {
        return $this->hasMany(Message::class, 'to', 'id');
    }

    public function getAvatarAttribute($value)
    {
        return $value ? $value : asset('assets/media/users/default.jpg');
    }

    public function isSuperAdmin()
    {
        return $this->group->type == 'super_admin';
    }

    public function isAdmin()
    {
        return $this->group->type == 'admin';
    }

    public function isOther()
    {
        return $this->group->type == 'other';
    }

    public function isStaff()
    {
        return $this->group->type == 'staff';
    }

    public function deleteUser($id)
    {
        $booking_ids = collect(DB::table('booking')->select('id')->where('uid', $id)->orWhere('staff_id', $id)->get()->toArray())->flatten()->map(function ($value) {
            return (int)$value->id;
        })->toArray();
        DB::table('booking_rating')->whereIn('booking_id', $booking_ids)->delete();
        DB::table('booking_service')->whereIn('booking_id', $booking_ids)->delete();
        DB::table('booking')->whereIn('id', $booking_ids)->delete();
        DB::table('user_setting')->where('uid', $id)->delete();
        $this->created_pages()->delete();
        $this->updated_pages()->delete();
        $this->created_category()->delete();
        $this->updated_category()->delete();
        $this->booked()->delete();
        $this->booking_rating()->delete();
        $this->services()->delete();
        $this->booking()->delete();
        $this->notifications()->delete();
        $this->request_supports()->delete();
        $this->group()->delete();
        $this->user_setting()->delete();
        $this->message_from()->delete();
        $this->message_to()->delete();
        $this->findOrFail($id)->delete();
    }
}

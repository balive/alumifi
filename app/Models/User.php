<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , Billable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'remaining_credits',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscribed()
    {
        if(isset($this->current_subscription()->id))
        {
            return true;
        }

        return false;
    }

    public function exceeded_subscription()
    {
        if(isset($this->current_subscription()->id) && $this->current_subscription()->quote_exceeded)
        {
            return true;
        }

        return false;
    }

    public function current_subscription()
    {
        if(auth()->user()->subscription('default')){

            return auth()->user()->subscription('default');
        }else {

            return Subscription::where('user_id' , $this->id)->where('stripe_status', 'active')->first();
        }

    }

    public function current_plan()
    {
        return Plan::where('id' , $this->current_subscription()->plan_id)->first();
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class , 'user_id')->orderBy('id', 'desc');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}

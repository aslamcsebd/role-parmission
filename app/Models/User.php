<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $fillable = [
		'name',
		'email',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	// Parmission
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}
	
	public function hasPermission($permission)
	{
		return $this->roles()
			->whereHas('permissions', fn($q) => $q->where('name', $permission))
			->exists();

		// return $this->roles()->whereHas('permissions', function ($q) use ($permission) {
        //     $q->where('name', $permission);
        // })->exists();
	}
}
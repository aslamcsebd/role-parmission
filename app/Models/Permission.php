<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'permission_category_id'];
	
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

    public function category()
    {
        return $this->belongsTo(PermissionCategory::class, 'permission_category_id');
    }
}

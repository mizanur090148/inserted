<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'user_id', 'project_id',
    ];

	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function project()
	{
	    return $this->belongsTo(Project::class);
	}
}

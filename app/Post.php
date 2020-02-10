<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = ['headline', 'content', 'user_id'];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id'
    ];

    public function user() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}

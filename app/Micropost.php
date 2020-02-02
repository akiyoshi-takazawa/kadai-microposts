<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 追加

class Micropost extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    
    protected $fillable = ['content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // favorite_users()でお気に入りにしたユーザーIDデータの取得
    
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
    
}
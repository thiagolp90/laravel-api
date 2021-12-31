<?php

namespace App\Models;

use App\Traits\HasAttachments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes, HasAttachments;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'message'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['user_id'];

    /**
    * Get the parent messageable model (user...).
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
    */
    public function messageable()
    {
        return $this->morphTo();
    }

    /**
     * Relationship with user's table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(User::class);
    }
}

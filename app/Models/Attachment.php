<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'path'];

    /**
    * Get the parent attachable model (message...).
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
    */
    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     * Get url file from the path
     */
    public function getUrlFile()
    {
        return Storage::url($this->path);
    }
}

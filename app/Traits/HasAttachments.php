<?php


namespace App\Traits;


trait HasAttachments
{

    /**
     * Get the message's attachments.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}

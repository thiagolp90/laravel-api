<?php


namespace App\Traits;


trait HasMessages
{

    /**
     * Get the user's messages.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }

}

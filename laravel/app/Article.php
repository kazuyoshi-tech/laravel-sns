<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Ralations\BelongsTo;

class Article extends Model
{
    public function user(): BelongsTo {
        return $this->belongsTo('App\User');
    }
}

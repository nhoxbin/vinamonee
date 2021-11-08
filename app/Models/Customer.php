<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Customer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['info', 'is_appraised', 'is_disbursed'];
    protected $casts = ['info' => 'json'];

    protected $appends = [''];

    public function getImagesAttribute() {
        return $this->getMedia('images')->getUrl('thumb');
    }
}

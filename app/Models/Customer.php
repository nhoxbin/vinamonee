<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Customer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['info', 'is_appraised', 'is_disbursed', 'appraised_by', 'disbursed_by'];
    protected $casts = ['info' => 'json'];
    protected $with = ['media'];
    protected $appends = ['status', 'images'];

    public function getImagesAttribute() {
        return collect([
            'saler' => $this->getMedia('saler_files'),
            'appraiser' => $this->getMedia('appraiser_files'),
        ]);
    }

    public function getStatusAttribute() {
        return $this->is_disbursed ? 'Đã giải ngân' : ($this->is_appraised ? 'Đã thẩm định' : 'Chưa duyệt');
    }

    public function payments() : HasMany {
        return $this->hasMany(Payment::class)->latest('id');
    }

    public function profiles() {
        return $this->belongsToMany(Profile::class, 'profiles', 'id', 'created_by')->latest('id');
    }
}

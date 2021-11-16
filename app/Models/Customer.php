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

    protected $fillable = ['info', 'is_appraised', 'is_disbursed'];
    protected $casts = ['info' => 'json'];

    protected $appends = ['status', 'files'];

    public function getFilesAttribute() {
        // return $this->getMedia('customers')->getUrl('thumb');
        return null;
    }

    public function getStatusAttribute() {
        return $this->is_disbursed ? 'Đã giải ngân' : ($this->is_appraised ? 'Đã thẩm định' : 'Chưa duyệt');
    }

    public function payments() : HasMany {
        return $this->hasMany(Payment::class)->latest('id');
    }
}

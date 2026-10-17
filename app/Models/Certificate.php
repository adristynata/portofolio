<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'year',
        'type',
        'link',
        'image',
    ];

    /**
     * Get the accessible image URL, whether it's a relative storage path, external URL, or Base64 data URI.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image) || $this->image === '0') {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, 'data:')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}

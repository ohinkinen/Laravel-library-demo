<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    public function libraries(): BelongsToMany {
        return $this->belongsToMany(Library::class);
    }

    public $timestamps = true;

    protected $fillable = ['title', 'createdAt'];
}

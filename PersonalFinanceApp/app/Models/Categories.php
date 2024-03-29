<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopes() : HasMany
    {
        return $this->hasMany(CategoryScope::class,'category_id');
    }

}

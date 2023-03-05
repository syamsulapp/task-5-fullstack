<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = ['name', 'users_id', 'created_at', 'updated_at', 'deleted_at'];
    use HasFactory;

    // relation table category ke table article
    public function articles(): HasMany
    {
        return $this->hasMany(Articles::class, 'category_id');
    }
}

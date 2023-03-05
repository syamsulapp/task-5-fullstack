<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $fillable = ['title', 'content', 'image', 'users_id', 'category_id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteToken extends Model
{
    protected $table = 'oauth_access_tokens';
    protected $fillable = ['user_id'];
    use HasFactory;
}

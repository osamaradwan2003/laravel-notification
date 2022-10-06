<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int|string|null $id)
 */
class NotifySettings extends Model
{
    use HasFactory;

    protected $fillable = [
        "id" ,
        "channel" ,
        "is_active" ,
        "created_at" ,
        "updated_at",
    ];
}

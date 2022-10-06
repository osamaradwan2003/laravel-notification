<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authentication;

/**
 * @method static find($id)
 * @property mixed $email
 */
class Todo extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'descriptions',
        'compleated'
    ];



}

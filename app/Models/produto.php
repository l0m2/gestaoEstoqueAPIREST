<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    use HasFactory;

    protected $table='produtos';
    
    protected $fillable = [
      'nome',
     'descrição',
      'preço',
       'quantidade'
    ];
}

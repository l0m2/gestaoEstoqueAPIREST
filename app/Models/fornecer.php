<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fornecer extends Model
{
    use HasFactory;
    protected $table='fornecers';
    
    protected $fillable = [
       'firstname',
       'lastname',
       'contacto',
       'endereco'
      ];
}

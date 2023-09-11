<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\produto;
use App\Models\User;

class movimentaçãoEstoque extends Model
{
    use HasFactory;

    public function produto()
    {
        return $this->belongsTo(produto::class, 'produto_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $table='movimentação_estoques';

    protected $fillable = [
       'user_id',
        'produto_id',
        'tipo_movimentacao', 
        'quantidade'
    ];
}

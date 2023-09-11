<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pedidoCompra;
use App\Models\produto;

class itensPedidoCompra extends Model
{
    use HasFactory;

    public function pedidoCompra()
    {
        return $this->belongsTo(pedidoCompra::class, 'pedido_compra_id');
    }

    public function produto()
    {
        return $this->belongsTo(produto::class, 'produto_id');
    }

    protected $table='itens_pedido_compras';

    protected $fillable = [
        'pedido_compra_id',
       'produto_id',
        'quantidade',
        'preco_unitario'
    ];
}

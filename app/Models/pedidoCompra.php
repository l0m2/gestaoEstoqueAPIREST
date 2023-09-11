<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\fornecer;
class pedidoCompra extends Model
{
    use HasFactory;

    public function fornecedor()
    {
        return $this->belongsTo(fornecer::class, 'fornecedor_id');
    }
    protected $table='pedido_compras';

    protected $fillable = [
       'fornecedor_id',
       'status'
    ];
}

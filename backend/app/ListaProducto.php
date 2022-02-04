<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaProducto extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = ['producto_id', 'user_id', 'cantidad', 'created_at', 'updated_at', 'deleted_at'];
}

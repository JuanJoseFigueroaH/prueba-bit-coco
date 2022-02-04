<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = ['codigo', 'nombre', 'created_at', 'updated_at', 'deleted_at'];
}

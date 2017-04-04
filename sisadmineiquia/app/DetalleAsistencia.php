<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class DetalleAsistencia extends Model
{
    protected $table='detalleasistencia';

    protected $primaryKey='iddetalleasistencia';

    public $timestamps=false;


    protected $fillable =[
    	'idasistencia',
    	'idexpediente',
    	'horaentrada',
    	'horasalida',
    	'observaciones'
    ];
}

<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table='asistencia';

    protected $primaryKey='idasistencia';

    public $timestamps=false;


    protected $fillable =[
    	'fechaasistencia',
    	'turno'
    ];
}

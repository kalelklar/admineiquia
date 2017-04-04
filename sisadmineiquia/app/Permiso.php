<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table='permiso';

    protected $primaryKey='idpermiso';

    public $timestamps=false;


    protected $fillable =[
    	'idexpediente',
    	'fechasolicitud',
    	'motivopermiso',
    	'tmposolicitadohora',
        'tmposolicitadomin',
    	'gocesueldo',
    	'estadopermiso',
    	'fechapermiso',
    	'cargodocente'
    ];
}

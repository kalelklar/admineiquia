<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class ExpedienteAcademico extends Model
{
    //
    protected $table='expedienteacademic';
    protected $primaryKey='idexpedienteacadem';
    public $timestamps=false;

    protected $fillable=['idempleado','fechaaperturaexpacad','nombreinstitucion','anotitulacion','tituloobtenido','direccioninstitucion','descripcionacademica','postgrados'];
}

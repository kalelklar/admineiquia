<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class CargaAcademica extends Model
{
    //
    protected $table='asignacionacademic';
    protected $primaryKey='idasignacionacad';
    public $timestamps=false;

    protected $fillable=['idexpedienteacadem','idciclo','ano','codasignatura','nombreasignatura','gteorico','gdiscusion','glaboratorio','tiempototal','responsabilidadadmin'];
}

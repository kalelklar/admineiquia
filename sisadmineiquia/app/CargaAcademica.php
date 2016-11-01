<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class CargaAcademica extends Model
{
    //
    protected $table='asignacionacademic';
    protected $primaryKey='idexpedienteacadem';
    public $timestamps=false;

    protected $fillable=['idciclo','ano','codasignatura','nombreasignatura','gteorico','gdiscusion','glaboratorio','tiempototal','responsabilidadadmin'];
}

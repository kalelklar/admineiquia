<?php

namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboralAcademica extends Model
{
    //
    protected $table='experiencialaboral';
    protected $primaryKey='idexplabacademica';
    public $timestamps=false;

    protected $fillable=['idexpedienteacadem','descripcionexplab','nombreintitucionexplabacad','fechainicioexplabacad','fechafinalizacionexplabacad'];
}

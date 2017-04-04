<?php


namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Empleado extends Model
{
    //
    protected $table='empleado';
    protected $primaryKey='idempleado';
    public $timestamps=false;

    protected $fillable=['primernombre','segundonombre','primerapellido','segundoapellido','dui','nit','isss','afp','estado','foto','sexo'];
}

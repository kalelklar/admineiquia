<?php


namespace sisadmineiquia;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Acuerdos extends Model
{
    //
    protected $table='acuerdoadministrat';
    protected $primaryKey='idacuerdo';
    public $timestamps=false;

    protected $fillable=['idempleado','motivoacuerdo','descripcionacuerdo','estadoacuerdo','fechaacuerdo','archivoacuerdo'];
}
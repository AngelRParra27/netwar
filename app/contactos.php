<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactos extends Model
{
    protected $fillable = [
    	'nombre',
    	'direccion',
    	'telefono',
    	'apellido_paterno',
    	'apellido_materno',
    	'ciudad',
    	'estado',
    ];
    public function ciudad(){
    	return $this->belongsTo('App\ciudades', 'ciudad', 'id');
    }
    public function estado(){
    	return $this->belongsTo('App\estados', 'estado', 'id');
    }
    
}

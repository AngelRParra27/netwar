<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estados extends Model
{
     protected $table ="estados";


	public function ciudades()
	{
   		return $this->belongsToMany('App\ciudades', 'estados_municipios', 
      	'estados_id', 'municipios_id');
	}
 
}

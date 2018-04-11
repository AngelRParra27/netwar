<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class citas extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'citas';
    protected $fillable =[
    	'hora',
    	'fecha',
    	'status',
    	'contacto_id',
    ];
    public function contacto(){
    	return $this->hasOne('App\contactos', 'id', 'contacto_id');
    }
}

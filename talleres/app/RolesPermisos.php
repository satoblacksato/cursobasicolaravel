<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesPermisos extends Model
{
    protected $table="roles_permisos";
    protected $fillable=['rol_id','permiso_id'];

    public function roles(){
    	return $this->belongsTo('App\Roles');
    }

    public function permisos(){
    	return $this->belongsTo('App\Permisos');
    }
}

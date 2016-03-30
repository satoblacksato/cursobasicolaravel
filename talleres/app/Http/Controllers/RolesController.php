<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Permisos;
use App\Http\Requests\RolesRequest;
use DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$objRoles=Roles::paginate(5); 
$request->scope= $request->scope==NULL?'':$request->scope;
$objRoles=Roles::search($request->scope)->orderBy('nombre','ASC')->paginate(5);


       return view('roles.index')->with([
            'objRoles' => $objRoles
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos=Permisos::orderBy('id','desc')
       ->lists('nombre','id');
       // ->select('id','nombre');  //extraer ciertos camps


 return view('roles.create',compact('permisos',$permisos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
       DB::transaction(function() use($request){
        $objRoles=new Roles();
        $objRoles->nombre=$request->nombre;
        $objRoles->estado=$request->estado;
        $objRoles->save();



        $arrayRolPermiso=array();
    foreach ($request->permisos as $key => $value) {
           $arrayRolPermiso[]=
           array('rol_id'=>$objRoles->id,
                 'permiso_id'=>$value);
        }

        if(count($arrayRolPermiso)>0){
            DB::table('roles_permisos')->insert($arrayRolPermiso);
        }

       }); 
       return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objRol=Roles::find($id);
        return view('roles.edit')->with([
            'objRol'=>$objRol
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request,$id){
        $objRol=Roles::find($id);
        $objRol->nombre=$request->nombre;
        $objRol->estado=$request->estado;
        $objRol->save();
        });
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    DB::transaction(function() use($id){
        $objRol=Roles::find($id);
        $objRol->delete();
        });
     return redirect()->route('roles.index');
    }
}

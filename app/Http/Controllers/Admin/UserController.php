<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $usuarios = User::all(); */
        //con esto los valores estaran dentro de data[]
        // la peticion ajax va con usuarios=user para mostrar el numero de registros
        //segun lo que se cambie en paginate
        if(!$request->ajax()) return redirect('/');

        $buscar =$request->buscar;
        $criterio=$request->criterio;

        if($buscar==''){
            $usuarios = User::orderBy('id','desc')->paginate(3);
        }
        else{
            $usuarios = User::where($criterio , 'like', '%'. $buscar . '%')->orderBy('id','desc')->paginate(3);
        }

        /* $usuarios = User::paginate(4); */
        return [
            'pagination' =>[
                'total'             =>$usuarios->total(),
                'current_page'      =>$usuarios->currentPage(),
                'per_page'          =>$usuarios->perPage(),
                'last_page'         =>$usuarios->lastPage(),
                'from'              =>$usuarios->firstItem(),
                'to'                =>$usuarios->lastItem(),
            ],
            'usuarios' => $usuarios 
        ];
        /* return $usuarios; */
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try{
        
        //aqui se guardan los usuarios
        $usuario = new User();
        $usuario->dui = $request->dui;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nit = $request->nit;
        $usuario->fechaNacimiento = $request->fechaNacimiento;
        $usuario->estado = $request->estado ? true : false;//OJO NO SE SI FUNCIONE PONER ATENCION AQUI FRAN
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        
        }catch(Exception $e){
            report($e);
        }

        
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function update(Request $request, $id) */
    public function update(Request $request)
    {
        //aqui se actualizan los usuarios
        $usuario =  User::findOrFail($request->id);
        $usuario->dui = $request->dui;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nit = $request->nit;
        $usuario->fechaNacimiento = $request->fechaNacimiento;
        $usuario->estado = $request->estado ? true : false;//OJO NO SE SI FUNCIONE PONER ATENCION AQUI FRAN
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try 
        {
            User::destroy($id);
        }
    
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function desactivar(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $usuario->estado = false;
        $usuario->save();
    }
    public function activar(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $usuario->estado = true;
        $usuario->save();
    }
}

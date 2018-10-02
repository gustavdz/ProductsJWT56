<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class UserController extends Controller
{
    public function indexview(Request $request){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $users = User::where('id', '!=',$user->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('username', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('users.show')->with(compact('users'));
    }

    public function getemail(Request $request,$id)
    {
        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $user = User::find($id);

        return view('users.email')->with(compact('user'));
    }

    public function getview()
    {
        $user = User::find(Auth::user()->id);
        var_dump($user);

        /*if($user->empresas->count()<1 or $user->empresas==null){
            $empresa['action']='create';
            $empresa['id']='';
            $empresa['razon_social']='';
            $empresa['nombre_comercial']='';
            $empresa['direccion_matriz']='';
            $empresa['direccion_sucursal']='';
            $empresa['ruc_empresa']='';
            $empresa['telefono']='';
            $empresa['logo']='';
            $empresa['ambiente']='';
            $empresa['secuencial_fact']='';
            $empresa['secuencial_nc']='';
            $empresa['prefijo_sucursal']='';
            $empresa['prefijo_emision']='';
        }else{
            $empresa['action']='edit';
            $empresa['id']=$user->empresas->id;
            $empresa['razon_social']=$user->empresas->razon_social;
            $empresa['nombre_comercial']=$user->empresas->nombre_comercial;
            $empresa['direccion_matriz']=$user->empresas->direccion_matriz;
            $empresa['direccion_sucursal']=$user->empresas->direccion_sucursal;
            $empresa['ruc_empresa']=$user->empresas->ruc_empresa;
            $empresa['telefono']=$user->empresas->telefono;
            $empresa['logo']=$user->empresas->logo_filename;
            $empresa['ambiente']=$user->empresas->ambiente;
            $empresa['secuencial_fact']=$user->empresas->secuencial_fact;
            $empresa['secuencial_nc']=$user->empresas->secuencial_nc;
            $empresa['prefijo_sucursal']=$user->empresas->prefijo_sucursal;
            $empresa['prefijo_emision']=$user->empresas->prefijo_emision;


        }*/
        //return view('profile.edit')->with(compact('user','empresa'));
    }
    public function update(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $messages =[
            'name.required' => 'Es necesario ingresar un nombre para el cliente.',
            'username.required' => 'Es necesario ingresar un apellido para el cliente.',
            'email.required' => 'Es necesario ingresar un correo para el cliente.',


        ];
        $rules = [
            'name' => 'required|min:2',
            'username' => 'required|min:6|unique:users,username,'.$user->id,
            'email' => 'required|max:200|unique:users,email,'.$user->id,


        ];
        $this->validate($request,$rules,$messages);


        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se actualizaron los datos correctamente','alert_type'=>'info']);

    }
    public function update_password(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $messages =[
            'password.required' => 'Es necesario ingresar una contraseña',
            'password.min'=>'La contraseña debe tener mínimo 6 caracteres.',

        ];
        $rules = [
            'password' => 'required|string|min:6|confirmed'

        ];
        //$this->validate($request,$rules,$messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Ocurrió un error al cambiar la contraseña, intente nuevo','alert_type'=>'error'])
                ->with('errors',$validator->errors());
        }


        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'La contraseña se actualizó correctamente','alert_type'=>'info']);


    }

    public function update_picture(Request $request)
    {

        $messages =[
            'profilepicture_filename.mimes' => 'Es necesario subir un archivo de tipo imagen',
            'profilepicture_filename.required' => 'Es necesario subir un archivo de tipo imagen',
            'profilepicture_filename.dimensions' => 'La imagen debe tener el mismo alto que ancho',
        ];
        $rules = [
            'profilepicture_filename' => 'required|mimes:jpeg,jpg,png|dimensions:ratio=2/2',


        ];
        $this->validate($request,$rules,$messages);

        if ($request->hasFile('profilepicture_filename')) {
            $file = $request->file('profilepicture_filename');
            $path = public_path('/images/users');
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }

        $user = User::find(Auth::user()->id);
        $user->profilepicture_filename = $fileName;
        $user->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se actualizó la imagen correctamente','alert_type'=>'info']);

    }

    public function update_p12(Request $request)
    {

        $messages =[
            'p12_filename.mimes' => 'Es necesario subir un archivo de tipo p12',
            'p12_filename.required' => 'Es necesario subir un archivo',

        ];
        $rules = [
            'p12_filename' => 'required|mimes:bin',


        ];

        //$validator=$this->validate($request,$rules,$messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Ocurrió un error al cargar el certificado, intente cargando de nuevo el archivo .p12','alert_type'=>'error'])
                ->with('errors',$validator->errors());;
        }

        if ($request->hasFile('p12_filename')) {
            $file = $request->file('p12_filename');
            $path = public_path('/cert/users');
            $fileName = $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }

        $user = User::find(Auth::user()->id);
        $user->p12_filename = $fileName;
        $user->p12_password = encrypt($request->input('p12_password'));
        $user->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se cargó el certificado correctamente','alert_type'=>'info']);

    }
}

<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Empresas;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class EmpresaController extends Controller
{
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $empresas = Empresas::where('user_id', $user->id)->get();//->paginate();
        return $empresas;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $empresa_request = $request->only('razon_social','nombre_comercial','logo','direccion_matriz','direccion_sucursal','ruc_empresa','telefono');
        $empresa_request['user_id']=$user->id;
        $empresa = Empresas::create($empresa_request);
        return $empresa;
    }
    public function get($id){
        $empresa = Empresas::find($id);
        return $empresa;
    }
    public function edit($id, Request $request){
        $empresa = $this->get($id);
        $empresa -> fill($request->all())->save();
        return $empresa;
    }
    public function delete($id){
        $empresa = $this->get($id);
        $empresa->delete();
        return $empresa;
    }

    public function update($id, Request $request){
        $messages =[
            'razon_social.required' => 'Es necesario ingresar una razón social para la emisión de la factura',
            'razon_social.min'=> 'La razón social para la factura debe tener al menos 3 caracteres.',
            'nombre_comercial.required' => 'Es necesario ingresar un nombre comercial para la emisión de la factura',
            'nombre_comercial.min'=> 'El nombre comercial para la factura debe tener al menos 3 caracteres.',
            'direccion_matriz.required' => 'Es necesario ingresar una dirección de la matriz para la emisión de la factura',
            'direccion_matriz.min'=> 'La dirección de la matriz para la factura debe tener al menos 3 caracteres.',
            'direccion_sucursal.required' => 'Es necesario ingresar una dirección de la sucursal para la emisión de la factura',
            'direccion_sucursal.min'=> 'La dirección de la sucursal para la factura debe tener al menos 3 caracteres.',
            'ruc_empresa.required' => 'Es necesario ingresar un RUC para la emisión de la factura',
            'ruc_empresa.min'=> 'El RUC para la factura debe tener 13 caracteres.',
            'ruc_empresa.max'=> 'El RUC para la factura debe tener no mas de 13 caracteres.',
            'telefono.required' => 'Es necesario ingresar un teléfono para la emisión de la factura',
            'telefono.min'=> 'El teléfono para la factura debe tener al menos 10 caracteres.',

        ];
        $rules = [
            'razon_social' => 'required|min:3',
            'nombre_comercial' => 'required|min:3',
            'direccion_matriz' => 'required|min:3',
            'direccion_sucursal' => 'required|min:3',
            'ruc_empresa' => 'required|min:13|max:13',
            'telefono' => 'required|min:10',
        ];
        //$this->validate($request,$rules,$messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Ocurrió un error al guardar la información, intente de nuevo','alert_type'=>'error'])
                ->with('errors',$validator->errors());;
        }

        $empresa = $this->get($id);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path('/logo/users');
            $fileName = $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }
        $empresa -> fill($request->all());
        $empresa->logo = $fileName;
        $empresa->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se actualizaron los datos correctamente','alert_type'=>'info']);
    }

    public function store(Request $request)
    {
        $messages =[
            'razon_social.required' => 'Es necesario ingresar una razón social para la emisión de la factura',
            'razon_social.min'=> 'La razón social para la factura debe tener al menos 3 caracteres.',
            'nombre_comercial.required' => 'Es necesario ingresar un nombre comercial para la emisión de la factura',
            'nombre_comercial.min'=> 'El nombre comercial para la factura debe tener al menos 3 caracteres.',
            'direccion_matriz.required' => 'Es necesario ingresar una dirección de la matriz para la emisión de la factura',
            'direccion_matriz.min'=> 'La dirección de la matriz para la factura debe tener al menos 3 caracteres.',
            'direccion_sucursal.required' => 'Es necesario ingresar una dirección de la sucursal para la emisión de la factura',
            'direccion_sucursal.min'=> 'La dirección de la sucursal para la factura debe tener al menos 3 caracteres.',
            'ruc_empresa.required' => 'Es necesario ingresar un RUC para la emisión de la factura',
            'ruc_empresa.min'=> 'El RUC para la factura debe tener 13 caracteres.',
            'ruc_empresa.max'=> 'El RUC para la factura debe tener no mas de 13 caracteres.',
            'telefono.required' => 'Es necesario ingresar un teléfono para la emisión de la factura',
            'telefono.min'=> 'El teléfono para la factura debe tener al menos 3 caracteres.',

        ];
        $rules = [
            'razon_social' => 'required|min:3',
            'nombre_comercial' => 'required|min:3',
            'direccion_matriz' => 'required|min:3',
            'direccion_sucursal' => 'required|min:3',
            'ruc_empresa' => 'required|min:13|max:13',
            'telefono' => 'required|min:10',
        ];
        //$this->validate($request,$rules,$messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Ocurrió un error al guardar la información, intente de nuevo','alert_type'=>'error'])
                ->with('errors',$validator->errors());;
        }

        $user = User::find(Auth::user()->id);
        $empresa_request = $request->only('razon_social','nombre_comercial','logo','direccion_matriz','direccion_sucursal','ruc_empresa','telefono');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path('/logo/users');
            $fileName = $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }
        $empresa_request['logo'] = $fileName;

        $empresa_request['user_id']=$user->id;
        $empresa = Empresas::create($empresa_request);

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se agregaron los datos de emisión correctamente','alert_type'=>'info']);
    }

}

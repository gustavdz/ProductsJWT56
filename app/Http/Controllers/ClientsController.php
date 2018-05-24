<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Clients;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;


class ClientsController extends Controller
{
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $clients = Clients::where('user_id', $user->id)->get();//->paginate();
        return $clients;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $client_request = $request->only('name','last_name','email','dni','phone','address');
        $client_request['user_id']=$user->id;
        $client = Clients::create($client_request);
        return $client;
    }
    public function get($id){
        $client = Clients::find($id);
        return $client;
    }
    public function edit($id, Request $request){
        $client = $this->get($id);
        $client -> fill($request->all())->save();
        return $client;
    }
    public function delete($id){
        $client = $this->get($id);
        $client->delete();
        return $client;
    }

    public function index(){
        $user = User::find(Auth::user()->id);
        $clients = Clients::where('user_id', '=',$user->id)->paginate(10);
        return view('clients.show')->with(compact('clients'));
    }
}

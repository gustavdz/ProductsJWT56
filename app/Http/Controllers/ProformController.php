<?php

namespace Products_JWT\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Products_JWT\Http\Requests\ProformOwnershipRequest;
use Products_JWT\Http\Requests\ProjectOwnershipRequest;
use Products_JWT\proform;
use Products_JWT\Proyectos;
use Products_JWT\User;

class ProformController extends Controller
{
    //

    public function getview(ProformOwnershipRequest $request){
        $proform = proform::find($request->proform_id);
        $proform->fecha_creacion = Carbon::parse($proform->created_at);
        return view('proformas.get')->with(compact('proform'));
    }

    public function createview(ProjectOwnershipRequest $request){
        $proyecto = Proyectos::find($request->id);
        return view('proformas.create')->with(compact('proyecto'));
    }
}

<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Http\Requests\TaskOwnershipRequest;
use Products_JWT\task;
use Products_JWT\User;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function indexview(Request $request,$proyecto_id){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $tasks = task::where('user_id', '=',$user->id)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('detail', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('tasks.show')->with(compact('tasks','proyecto_id'));
    }

    public function createview(){
        return view('tasks.create');
    }

    public function editview(TaskOwnershipRequest $request){
        $task = task::find($request->id);
        return view('tasks.edit')->with(compact('task'));
    }

    public function destroy(TaskOwnershipRequest $request,$id)
    {
        $task = task::find($request->id);
        $task->delete();

        return back()->with('notification',['title'=>'Notificación','message'=>'Se eliminó la tarea correctamente','alert_type'=>'warning']);
    }

    public function store(Request $request){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para el proyecto.',
            'title.min' => 'El nombre del proyecto debe tener mínimo 6 caracteres.',


        ];
        $rules = [
            'title' => 'required|min:6',


        ];
        $this->validate($request,$rules,$messages);

        $user = User::find(Auth::user()->id);
        $task_request = $request->only('title','detail','hours','points','complete','complete_date','proyecto_id');
        $task_request['user_id']=$user->id;

        $task = task::create($task_request);

        return redirect('/tasks')->with('notification',['title'=>'Notificación','message'=>'Se agregó la tarea correctamente','alert_type'=>'info']);

    }
    public function update(TaskOwnershipRequest $request,$id){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para el proyecto.',
            'title.min' => 'El nombre del proyecto debe tener mínimo 6 caracteres.',
        ];
        $rules = [
            'title' => 'required|min:6',

        ];
        $this->validate($request,$rules,$messages);

        $task = task::find($id);
        $task->title = $request->input('title');
        $task->proyecto_id = $request->input('proyecto_id');
        $task->detail = $request->input('detail');
        $task->hours = $request->input('hours');
        $task->points = $request->input('points');
        $task->complete = $request->input('complete');
        $task->complete_date = $request->input('complete_date');
        $task->save();

        return redirect('/tasks')->with('notification',['title'=>'Notificación','message'=>'Se editó la tarea correctamente','alert_type'=>'info']);

    }
}

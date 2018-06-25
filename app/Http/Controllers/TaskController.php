<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Http\Requests\ProjectOwnershipRequest;
use Products_JWT\Http\Requests\TaskOwnershipRequest;
use Products_JWT\task;
use Products_JWT\User;
use Products_JWT\Proyectos;
use Illuminate\Support\Facades\Auth;



class TaskController extends Controller
{
    public function indexview(ProjectOwnershipRequest $request,$proyecto_id){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $tasks = task::where('user_id', '=',$user->id)
            ->where ('proyectos_id','=',$proyecto_id)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('detail', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('tasks.show')->with(compact('tasks','proyecto_id'));
    }

    public function createview($proyecto_id){
        return view('tasks.create')->with(compact('proyecto_id'));
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

    public function store(Request $request,$proyecto_id){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para la tarea.',
            'title.min' => 'El nombre de la tarea debe tener mínimo 6 caracteres.',
        ];
        $rules = [
            'title' => 'required|min:6',
        ];
        $this->validate($request,$rules,$messages);

        $user = User::find(Auth::user()->id);
        $task_request = $request->only('title','detail','hours','points','complete','complete_date');
        $task_request['user_id']=$user->id;
        $task_request['proyectos_id']=$proyecto_id;

        $task = task::create($task_request);

        return redirect('/proyectos/'.$proyecto_id.'/tasks')->with('notification',['title'=>'Notificación','message'=>'Se agregó la tarea correctamente','alert_type'=>'info']);

    }
    public function update(TaskOwnershipRequest $request,$proyecto_id,$id){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para la tarea.',
            'title.min' => 'El nombre de la tarea debe tener mínimo 6 caracteres.',
        ];
        $rules = [
            'title' => 'required|min:6',
        ];
        $this->validate($request,$rules,$messages);
        $task = task::find($id);
        $task->title = $request->input('title');
        $task->proyectos_id = $request->input('proyecto_id');
        $task->detail = $request->input('detail');
        $task->hours = $request->input('hours','0');
        $task->points = $request->input('points','0');
        $task->complete = $request->input('complete','0');
        $task->complete_date = $request->input('complete_date',null);
        $task->save();

        return redirect('/proyectos/'.$proyecto_id.'/tasks')->with('notification',['title'=>'Notificación','message'=>'Se editó la tarea correctamente','alert_type'=>'info']);

    }
    public function complete(TaskOwnershipRequest $request,$proyecto_id,$id){

        $task = task::find($id);
        $task->complete = $request->input('complete','1');
        $task->complete_date = $request->input('complete_date',date(now()));
        $task->save();

        $project = Proyectos::find($proyecto_id);
        $total = $project->tasks()->count();
        $done = $project->tasks()->where('complete','=',true)->count();
        $porcent = ($done*100)/$total;

        if($porcent==100){
            $project->last_state = $project->estado;
            $project->estado='T';
            $project->save();
        }

        return redirect('/proyectos/'.$proyecto_id.'/tasks')->with('notification',['title'=>'Notificación','message'=>'Se completó la tarea correctamente','alert_type'=>'info']);

    }
    public function incomplete(TaskOwnershipRequest $request,$proyecto_id,$id){

        $project = Proyectos::find($proyecto_id);
        $total = $project->tasks()->count();
        $done = $project->tasks()->where('complete','=',true)->count();
        $porcent = ($done*100)/$total;

        if($porcent==100){
            $project->estado=$project->last_state;
            $project->save();
        }

        $task = task::find($id);
        $task->complete = $request->input('complete','0');
        $task->complete_date = $request->input('complete_date',null);
        $task->save();

        return redirect('/proyectos/'.$proyecto_id.'/tasks')->with('notification',['title'=>'Notificación','message'=>'Se marcó la tarea como pendiente correctamente','alert_type'=>'info']);

    }
}

<?php

namespace Products_JWT\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Products_JWT\task;

class TaskOwnershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $taskId = $this->route('id');
        $projectId = $this->route('proyecto_id');
        return task ::where('id', $taskId)
            ->where('proyectos_id', $projectId)
            ->where('user_id', $this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

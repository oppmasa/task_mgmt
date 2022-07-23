<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:64',
            'contents' => 'nullable|max:3000',
            'deadline' => 'required|date',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'contents' => '内容',
            'deadline' => '期限',
        ];
    }
}

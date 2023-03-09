<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:120',
            'priority' => 'required|numeric',
        ];
    }
	
	public function allowedInputs(): array
	{
		return $this->only(['name', 'priority']);
	}
}

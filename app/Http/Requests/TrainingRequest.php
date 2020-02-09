<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
                break;
            case 'DELETE':
                break;
            case 'POST':
            {
                return [
                    'name'       => 'required|min:3',
                    'description'       => 'required|min:3'
                ];
                break;
            }
            case 'PUT':
                return [
                    'name'       => 'required|min:3',
                    'id'       => 'required|numeric|exists:trainings',
                    'description'       => 'required|min:3',
                ];
                break;
            case 'PATCH':
                break;
            default:
            break;
        }

    }

    public function messages(){
        return [
            'name.required' => 'O campo nome é obrigatorio.',
            'name.min' => 'O campo nome deve conter mais de 3 caracteres.',

            'id.required' => 'O campo id é obrigatorio.',
            'id.numeric' => 'O campo id deve ser numerico',
            'id.exists' => 'O campo id informado não existe',

            'description.required' => 'O campo descricao é obrigatorio.',
            'description.min' => 'O campo descricao deve conter mais de 3 caracteres.',
        ];
    }
}

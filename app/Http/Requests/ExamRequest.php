<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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
                    'code'       => 'required|min:2',
                    'duration'       => 'required|min:3|numeric',
                ];
                break;
            }
            case 'PUT':
                return [
                    'name'       => 'required|min:3',
                    'id'       => 'required|numeric|exists:exams',
                    'code'       => 'required|min:2',
                    'duration'       => 'required|min:3|numeric',
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

            'code.required' => 'O campo sigla é obrigatorio.',
            'code.min' => 'O campo sigla deve conter mais de 2 caracteres.',

            'duration.required' => 'O campo duracao é obrigatorio.',
            'duration.min' => 'O campo duracao deve conter mais de 3 caracteres.',
            'duration.numeric' => 'O campo duracao deve ser numerico',
        ];
    }
}

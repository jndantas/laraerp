<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingEmployeeRequest extends FormRequest
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
                    'id'       => 'required|numeric|exists:treinamentos',
                    'date'       => 'required|date_format:d/m/Y',
                    'employees'       => 'required|exists:employees,id'
                ];
                break;
            }
            case 'PUT':
                break;
            case 'PATCH':
                break;
            default:
            break;
        }

    }

    public function messages(){
        return [
        'date.required' => 'O campo data é obrigatorio.',
        'date.date_format' => 'O campo data deve ser : DIA/MES/ANO',

        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',

        'employees.required' => 'O campo funcionarios é obrigatorio.',
        'employees.exists' => 'O campo funcionario informado não existe',
        ];
    }
}

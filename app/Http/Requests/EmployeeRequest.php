<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
                    'name' => 'required|min:3',
                    'document_number' => 'required|min:3|unique:employees,document_number',
                    'enterprise_id' => 'required|exists:enterprises,id',
                    'position_id' => 'required|exists:positions,id',
                ];
                break;
            }
            case 'PUT':
                return [
                    'id' => 'required|numeric|exists:employees',
                    'name' => 'required|min:3',
                    'enterprise_id' => 'required|exists:enterprises,id',
                    'position_id' => 'required|exists:positions,id',
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

            'document_number.required' => 'O campo CPF é obrigatorio.',
            'document_number.min' => 'O campo CPF deve conter mais de 3 caracteres.',
            'document_number.unique' => 'O CPF já existe no sistema',

            'enterprise.required' => 'O campo Empresa é obrigatorio.',
            'enterprise.exists' => 'O campo Empresa informado não existe',

            'position.required' => 'O campo Cargo é obrigatorio.',
            'position.exists' => 'O campo Cargo informado não existe',
        ];
    }
}

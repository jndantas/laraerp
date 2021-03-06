<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseRequest extends FormRequest
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
                    'name'=> 'required|min:3',
                    'title'=> 'required|min:3',
                    'document_number'=> 'required|cnpj|unique:enterprises,document_number,'
                ];
                break;
            }
            case 'PUT':
                return [
                    'name' => 'required|min:3',
                    'title'=> 'required|min:3',
                    'document_number'=> 'required|cnpj|unique:enterprises,document_number,' . $this->id
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
        'document_number.required' => 'Favor informar o Cnpj',
        'document_number.unique' => 'O Cnpj já está cadastrado',
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        ];
    }
}

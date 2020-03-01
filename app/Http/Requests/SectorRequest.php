<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorRequest extends FormRequest
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
                    'name'=> 'required|min:3|unique:sectors',
                    'enterprise_id'=> 'required|exists:enterprises,id'
                ];
                break;
            }
            case 'PUT':
                return [
                    'name'=> 'required|min:3|unique:sectors,name'. $this->id ,
                    'enterprise_id'=> 'requiredexists:enterprises,id'
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
        'name.required' => 'Escreva um nome para o Setor.',
        'name.unique' => 'Já existe um Setor com esse nome.',
        'name.min' => 'O Setor deve conter mais de 3 caracteres.',
        'enterprise_id.required' => 'Selecione pelo menos uma Empresa',
        'enterprise_id.exists' => 'A Empresa selecionada não existe',
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        ];
    }
}

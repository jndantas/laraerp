<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
                    'name'  => 'required|min:3',
                    'description'  => 'required|min:3',
                    'enterprise'=> 'required|exists:enterprises,id',
                    'sector'=> 'required|exists:sectors,id'
                ];
                break;
            }
            case 'PUT':
                return [
                    'name'       => 'required|min:3',
                    'id'       => 'required|numeric|exists:positions',
                    'description'  => 'required|min:3',
                    'enterprise'=> 'required|exists:enterprises,id',
                    'sector'=> 'required|exists:sectors,id'
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
        'name.required' => 'O nome do Cargo é obrigatorio.',
        'description.required' => 'Faça uma breve descrição',
        'name.min' => 'O campo name deve conter mais de 3 caracteres.',
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        'enterprise.required' => 'Selecione uma Empresa',
        'enterprise.exists' => 'A Empresa selecionada não existe',
        'sector.required' => 'Selecione um Setor',
        'sector.exists' => 'O Setor selecionado não existe'
        ];
    }
}

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
                    'enterprise_id'=> 'required|exists:enterprises,id',
                    'sector_id'=> 'required|exists:sectors,id'
                ];
                break;
            }
            case 'PUT':
                return [
                    'name'       => 'required|min:3',
                    'id'       => 'required|numeric|exists:positions'
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
        'name.min' => 'O campo name deve conter mais de 3 caracteres.',
        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',
        'enterprise_id.required' => 'Selecione uma Empresa',
        'enterprise_id.exists' => 'A Empresa selecionada não existe',
        'sector_id.required' => 'Selecione um Setor',
        'sector_id.exists' => 'O Setor selecionado não existe'
        ];
    }
}

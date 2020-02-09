<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputRequest extends FormRequest
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
                    'id'       => 'required|numeric|exists:produtos',
                    'date'       => 'required|date_format:d/m/Y',
                    'qntd'       => 'required|numeric|min:1'
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
        'date.required' => 'O campo Data é obrigatorio.',
        'date.date_format' => 'O campo Data deve ser : DIA/MES/ANO',

        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',

        'qntd.required' => 'O campo quantidade é obrigatorio.',
        'qntd.min' => 'O campo quantidade deve conter no minimo 1 unidade.',
        'qntd.numeric' => 'O campo quantidade deve ser numerico',
        ];
    }
}

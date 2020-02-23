<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutputStockRequest extends FormRequest
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
        if($this->has('max'))
            $max = $this->input('max');
        switch($this->method())
        {
            case 'GET':
                break;
            case 'DELETE':
                break;
            case 'POST':
            {
                return [
                    'id' => 'required|numeric|exists:produtos',
                    'employee'       => 'required|numeric|exists:employees,id',
                    'content'       => 'required',
                    'qntd'       => 'required|numeric|max:'.$max,
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

        'id.required' => 'O campo id é obrigatorio.',
        'id.numeric' => 'O campo id deve ser numerico',
        'id.exists' => 'O campo id informado não existe',

        'employee.required' => 'O campo funcionario é obrigatorio.',
        'employee.exists' => 'Este funcionario informado não existe',

        'content.required' => 'Faça as observações sobre a entrega do EPI.',

        'qntd.required' => 'A quantidade é obrigatoria.',
        'qntd.min' => 'O campo quantidade deve conter no minimo 1 unidade.',
        'qntd.numeric' => 'O campo quantidade deve ser numerico',
        'qntd.max' => 'Quantidade no estoque indisponivel'
        ];
    }
}

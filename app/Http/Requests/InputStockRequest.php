<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputStockRequest extends FormRequest
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
                    'product_id' => 'required|numeric|exists:products,id',
                    'document_number' => 'required',
                    'authorization_certificate_id' => 'required|exists:authorization_certificates,id',
                    'value' => 'required',
                    'date' => 'required|date_format:d/m/Y',
                    'qntd' => 'required|min:1'
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
        'document_number.required' => 'Insira o número da Nota Fiscal',

        'authorization_certificate_id.required' => 'Insira o CA do Produto.',
        'authorization_certificate_id.exists' => 'O campo CA informado não existe',

        'date.required' => 'Insira a Data da chegado do Produto.',
        'date.date_format' => 'O campo Data deve ser : DIA/MES/ANO',

        'product_id.required' => 'O campo id é obrigatorio.',
        'product_id.numeric' => 'O campo id deve ser numerico',
        'product_id.exists' => 'O campo id informado não existe',

        'value.required' => 'Informe o valor do produto.',
        'value.numeric' => 'Informe o valor do produto.',

        'qntd.required' => 'O campo quantidade é obrigatorio.',
        'qntd.min' => 'O campo quantidade deve conter no minimo 1 unidade.',
        'qntd.numeric' => 'O campo quantidade deve ser numerico',
        ];
    }
}

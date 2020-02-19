<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    'measure' => 'required',
                    'category_id' => 'required|exists:categories,id',
                    'stock_min' => 'required|numeric',
                    'ca' => 'required|numeric',
                ];
                break;
            }
            case 'PUT':
                return [
                    'id' => 'required|numeric|exists:products',
                    'name' => 'required|min:3',
                    'measure' => 'required',
                    'category_id' => 'required|exists:categories,id',
                    'ca' => 'numeric',
                    'stock_min' => 'numeric',
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
            'measure.required' => 'O campo tamanho é obrigatorio.',
            'category_id.required' => 'O campo categoria é obrigatorio.',
            'category_id.exists' => 'O campo categoria informado não existe',
            'min.numeric' => 'O campo minimo para lembrete deve ser numerico',
            'ca.numeric' => 'O campo CA deve ser numerico',
        ];
    }
}

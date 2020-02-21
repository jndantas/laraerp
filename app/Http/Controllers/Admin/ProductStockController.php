<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputStockRequest;
use App\Models\AuthorizationCertificate;
use App\Models\Input;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getViewInput($id)
    {
        $product = Product::findOrFail($id);
        $certificates = AuthorizationCertificate::all();
        return view('sesmt.product.input', compact('product', 'certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInput(InputStockRequest $request)
    {
        Input::create([
            'document_number' => $request->document_number,
            'date' => date("Y-m-d", strtotime($request->date)),
            'qntd' => $request->qntd,
            'authorization_certificate_id' => $request->authorization_certificate_id,
            'value' => str_replace(['.',','], ['','.'], $request->value),
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('products');

       //$time = strtotime('$request->date');
        //$newformat = date('Y-m-d',$time);
        //echo $newformat;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AuthorizationCertificate;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('category', 'reminders', 'authorizationCertificate')->paginate(10);
    }

    public function getCategories()
    {
        $data = Category::select('id', 'name')->get();
        return response()->json($data);
    }

    public function getCertificates()
    {
        $data = AuthorizationCertificate::select('id', 'document_number')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();
        $product = new Product;
        $product->name = $input['name'];
        $product->measure = $input['measure'];
        $product->stock_min = $input['stock_min'];

        $certificate = AuthorizationCertificate::findOrFail($input['authorization_certificate_id']);
        $product->authorizationCertificate()->associate($certificate);
        $category = Category::findOrFail($input['category_id']);
        $product->category()->associate($category);
        $product->save();

        if ($request->has('stock_min')){
            $reminder = new Reminder();
            $reminder->stock_min = $input['stock_min'];
            $reminder->product()->associate($product);
            $reminder->save();
        }
        return redirect()->back();

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        $certificate = AuthorizationCertificate::findOrFail($request['authorization_certificate_id']);
        $category = Category::findOrFail($request['category_id']);
        $product->category()->associate($category);
        $product->save();
        return ['message' => 'Atualizado'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return ['message' => 'Deletado'];
    }
}

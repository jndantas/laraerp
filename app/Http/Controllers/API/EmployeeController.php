<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::with('enterprise', 'position')->paginate(10);
    }

    public function getEnterprises()
    {
        $data = Enterprise::select('id', 'name')->get();
        return response()->json($data);
    }

    public function getPositions()
    {
        $data = Position::select('id', 'name')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->document_number = $request->document_number;
        $employee->position_id = $request->position_id;

        $enterprise = Enterprise::findOrFail($request->enterprise_id);
        $employee->enterprise()->associate($enterprise);
        $employee->save();
        return ['message' => 'Salvo'];

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
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->document_number = $request->document_number;
        $employee->enterprise_id = $request->enterprise_id;
        $enterprise = Enterprise::findOrFail($request->enterprise_id);
        $employee->enterprise()->associate($enterprise);
        $employee->save();

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
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return ['message' => 'Deletado'];
    }
}

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
        return Employee::with('enterprise', 'positions')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $input = $request->all();
        $employee = new Employee();
        $employee->name = $input['name'];
        $employee->document_number = $input['document_number'];
        $enterprise = Enterprise::findOrFail($input['enterprise']);
        $employee->enterprise()->associate($enterprise);

        $position = Position::findOrFail($input['position']);

        $employee->save();
        $employee->positions()->attach($position->id, [
            'date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
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
    public function update(EmployeeRequest $request, $id)
    {
        $input = $request->all();
        $employee = Employee::findOrFail($id);
        $employee->name = $input['name'];
        $employee->document_number = $input['document_number'];
        $enterprise = Enterprise::findOrFail($input['enterprise']);
        $employee->enterprise()->associate($enterprise);

        $position = Position::findOrFail($input['position']);
        if ($employee->position[0]->id != $position->id) {
            $employee->positions()->attach($position->id, [
            'date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }

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

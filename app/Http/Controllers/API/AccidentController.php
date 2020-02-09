<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccidentRequest;
use App\Models\Accident;
use App\Models\Employee;
use App\Models\TypeAccident;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Accident::with('typeAccident', 'employees')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccidentRequest $request)
    {
            $input = $request->all();
            $accident = new Accident();
            $accident->description = $input['description'];
            $accident->procedure = $input['procedure'];

            $type = TypeAccident::findOrFail($input['type_id']);
            $accident->type()->associate($type);

            $accident->save();
            if ($request->has('employee_id')) {

                $employees = Employee::whereIn('id',$request->get('employee_id'))->get();
                $data = array();
                foreach ($employees as $employee) {
                    $data[$employee->id] = [
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                    ];
                }

                $accident->employees()->sync($data);
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
    public function update(AccidentRequest $request, $id)
    {
            $input = $request->all();

            $accident = Accident::findOrFail($id);
            $accident->description = $input['description'];
            $accident->procedure = $input['procedure'];

            $type = TypeAccident::findOrFail($input['type_id']);
            $accident->type()->associate($type);

            $accident->save();
            if ($request->has('employee_id')) {

                $employees = Employee::whereIn('id',$request->get('employee_id'))->get();
                $data = array();
                foreach ($employees as $employee) {
                    $data[$employee->id] = [
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                    ];
                }

                $accident->employees()->sync($data);
            }

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
        $accident = Accident::findOrFail($id);
        $accident->delete();
        return ['message' => 'Deletado'];
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use App\Models\Sector;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Position::withCount('employees')->paginate(10);
    }

    public function getSectors(Request $request)
    {
        $data = Sector::where('enterprise_id', $request->enterprise_id)->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $input = $request->all();
        $position = new Position;
        $position->name = $input['name'];
        $position->enterprise_id = $input['enterprise'];
        $position->sector_id = $input['sector'];
        if ($request->has('description')) {
            $position->description = $input['description'];
        }

        $position->save();
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
    public function update(PositionRequest $request, $id)
    {
        $input = $request->all();
        $position = Position::findOrFail($id);
        $position->name = $input['name'];
        $position->description = $input['description'];

        $position->save();

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
        $position = Position::findOrFail($id);
        $position->delete();
        return ['message' => 'Apagado'];
    }
}

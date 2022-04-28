<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::all();
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'clinic_id' => 'required|integer',
            'start' => 'required|date',
            'end' => 'required|date',
            'duration' => 'required|numeric'
        ]);

        if ($validated) {
            $overlaps = Appointment::where('clinic_id', $request->clinic_id)->where('start', '<=', $request->start)->where('end', '>=', $request->start)->get();

            if (!$overlaps->isEmpty()) {
                return response()->json([ 'error' => 'Failed to create appointment. Time overlaps.'  ], 409);
            }

            $appointment = Appointment::firstOrCreate([
                'name' => $request->name,
                'clinic_id' => $request->clinic_id,
                'start' => $request->start,
                'end' => $request->end,
                'duration' => $request->duration
            ]);

            return response()->json([ 'stored' => $appointment ], 201);
        }

        return response()->json([ 'error' => 'Failed to create appointment.'  ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Appointment::find($id);
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
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return $appointment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::find($id)->delete();

        return 204;
    }
}

<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeePhoto;
use App\Http\Requests\EmployeeAddRequest;
use App\Http\Requests\EmployeeUpdRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $employees = Employee::with('employeephoto')->get();

        return view('listAll', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EmployeeAddRequest $request)
    {
        //
        $addEmployee = new Employee();
        $addEmployee->name = $request->name;
        $addEmployee->email = $request->email;
        $addEmployee->phone = $request->phone;
        $addEmployee->save();

        if ($request->hasFile('photo')) {
            $addEmployeePhoto = new EmployeePhoto();
            $addEmployeePhoto->employee_id = $addEmployee->id;
            $addEmployeePhoto->photo = $request->photo->store('public');
            $addEmployeePhoto->save();
        }

        return redirect('/employee-list');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $employee = Employee::find($id);

        return view('listDetail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $employee = Employee::find($id);

        return view('edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EmployeeUpdRequest $request)
    {
        //
        $addEmployee = Employee::find($request->id);
        $addEmployee->name = $request->name;
        $addEmployee->email = $request->email;
        $addEmployee->phone = $request->phone;
        $addEmployee->save();

        if ($request->hasFile('photo')) {
            $addEmployeePhoto = EmployeePhoto::find($request->id);
            if (isset($addEmployeePhoto)) {
                $deleteOrphanImage = $addEmployeePhoto->photo;
                $addEmployeePhoto->photo = $request->photo->store('public');
                $addEmployeePhoto->save();
                Storage::delete($deleteOrphanImage);
            } else {
                $addEmployeePhoto = new EmployeePhoto();
                $addEmployeePhoto->employee_id = $request->id;
                $addEmployeePhoto->photo = $request->photo->store('public');
                $addEmployeePhoto->save();
            }
        }

        return redirect('/employee-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //
        $addEmployeePhoto = EmployeePhoto::find($id);
        if (isset($addEmployeePhoto)) {
            $deleteOrphanImage = $addEmployeePhoto->photo;
            Storage::delete($deleteOrphanImage);
        }
        $remove = Employee::where('id', $id)->delete();
        if ($id) {
            return redirect('/employee-list');
        }
        Employee::findOrFail($id);
    }
}

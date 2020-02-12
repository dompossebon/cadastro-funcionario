<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeePhoto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        //
        Validator::make($request->all(), [
            'name' => 'required|min:3|max:150',
            'email' => 'required|unique:employees,email|max:100',
            'phone' => 'required|min:11',
            'photo' => 'mimes:jpeg,bmp,png',
        ])->validate();

        try {
            DB::beginTransaction();
            $addEmployee = new Employee();
            $addEmployee->name = $request->name;
            $addEmployee->email = $request->email;
            $addEmployee->phone = $request->phone;
            $addEmployee->save();
            DB::commit();

            if ($request->hasFile('photo')) {

                try {
                    DB::beginTransaction();
                    $addEmployeePhoto = new EmployeePhoto();
                    $addEmployeePhoto->employee_id = $addEmployee->id;
                    $addEmployeePhoto->photo = $request->photo->store('public');
                    $addEmployeePhoto->save();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect('/employee-list')->with('danger', 'Erro ao manipular o arquivo de foto do Funcionário!');
                }
            }
            return redirect('/employee-list')->with('success', 'Funcionário Salvo com sucesso!');

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect('/employee-list')->with('danger', 'Erro ao tentar Salvar Funcionário!');

        }
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
        $phone = substr($employee->phone, 1, 2) . substr($employee->phone, 4, 5) . substr($employee->phone, 10, 4);

        return view('edit', compact('employee', 'phone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        //
        Validator::make($request->all(), [
            'name' => 'required|min:3|max:150',
            'email' => 'required|max:100',
            'phone' => 'required|min:11',
            'photo' => 'mimes:jpeg,bmp,png',
        ])->validate();

        try {

            DB::beginTransaction();
            $addEmployee = Employee::find($request->id);
            $addEmployee->name = $request->name;
            $addEmployee->email = $request->email;
            $addEmployee->phone = $request->phone;
            $addEmployee->save();
            DB::commit();

            if ($request->hasFile('photo')) {
                $addEmployeePhoto = EmployeePhoto::find($request->id);
                if (isset($addEmployeePhoto)) {

                    try {
                        DB::beginTransaction();
                        $deleteOrphanImage = $addEmployeePhoto->photo;
                        $addEmployeePhoto->photo = $request->photo->store('public');
                        $addEmployeePhoto->save();
                        DB::commit();
                        Storage::delete($deleteOrphanImage);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect('/employee-list')->with('danger', 'Erro ao manipular o arquivo de foto do Funcionário!');
                    }

                } else {

                    try {
                        DB::beginTransaction();
                        $addEmployeePhoto = new EmployeePhoto();
                        $addEmployeePhoto->employee_id = $request->id;
                        $addEmployeePhoto->photo = $request->photo->store('public');
                        $addEmployeePhoto->save();
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect('/employee-list')->with('danger', 'Erro ao manipular o arquivo de foto do Funcionário!');
                    }
                }
            }
            return redirect('/employee-list')->with('success', 'Funcionário Atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/employee-list')->with('danger', 'Erro ao tentar Atualizar Funcionário!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;

        $addEmployeePhoto = EmployeePhoto::find($id);

        if (isset($addEmployeePhoto)) {

            $deleteOrphanImage = 'teste' . $addEmployeePhoto->photo;
            Storage::delete($deleteOrphanImage);

        }

        DB::beginTransaction();
        try {

            Employee::where('id', $id)->delete();
            DB::commit();

            return redirect('/employee-list')->with('success', 'Funcionário Excluido com sucesso!');

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect('/employee-list')->with('danger', 'Erro ao tentar excluir Funcionário!');

        }
    }
}

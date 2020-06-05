<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Owner;
use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $employees = Employee::where('owner_id', $owner->id)->paginate(15);

        return view('employees.index', compact('owner', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        switch ($owner->category->id) {
            case 7:
                $roles = Rol::where('id', '!=', 1)->orderBy('name')->get();
                break;

            default:
                $roles = Rol::orderBy('name')->get();
                break;
        }

        return view('employees.create', compact('owner', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = \Str::random(6);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->password = Hash::make($password);
        $user->save();

        $owner = Owner::where('slug', $request->slug)->first();

        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->owner_id = $owner->id;
        $employee->save();

        $request->session()->flash('message', 'Empleado creado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/employees');
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
    public function edit($slug, $id)
    {
        $owner = Owner::where('slug', $slug)->first();

        switch ($owner->category->id) {
            case 7:
                $roles = Rol::where('id', '!=', 1)->orderBy('name')->get();
                break;

            default:
                $roles = Rol::orderBy('name')->get();
                break;
        }

        $employee = Employee::find($id);

        return view('employees.edit', compact('owner', 'roles', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Request $request, $id)
    {
        $employee = Employee::find($id);

        $user = $employee->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->save();

        $request->session()->flash('message', 'Empleado actualizado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        Employee::destroy($id);

        session()->flash('message', 'Empleado eliminado con éxito.');
        session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function sendPassword($id){
        $user = User::find($id);
    }
}

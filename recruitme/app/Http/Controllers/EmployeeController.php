<?php

namespace App\Http\Controllers;

use App\Address;
use App\Company;
use App\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index',['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create',['companies'=>Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $cpf = str_replace(['.','-'], '', $request->cpf);
        $phone = str_replace(['(',')','-',' '], '', $request->phone);
        $cep = str_replace(['-'], '', $request->cep);
        $request->merge([
            'cpf'=>$cpf,
            'phone'=>$phone,
            'cep'=>$cep
        ]);
        try {
            DB::beginTransaction();
            $employee = Employee::create($request->all());
            $employee->address()->create($request->all());
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput();
        }

        DB::commit();
        $employees = Employee::paginate(10);
        return view('employees.index', ['employees'=>$employees]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', ['employee'=>$employee->load('address')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee'=>$employee->load(['address','company']),'companies'=>Company::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $cpf = str_replace(['.','-'], '', $request->cpf);
        $phone = str_replace(['(',')','-',' '], '', $request->phone);
        $cep = str_replace(['-'], '', $request->cep);
        $request->merge([
            'cpf'=>$cpf,
            'phone'=>$phone,
            'cep'=>$cep
        ]);
        try {
            DB::beginTransaction();
            $employee->update($request->all());
            $employee->address()->update(
                [
                    'employee_id' => $employee->id,
                    'cep' => $request->cep,
                    'street' => $request->street,
                    'number' => $request->number,
                    'neighborhood' => $request->neighborhood,
                    'city' => $request->city,
                    'state' => $request->state,
                    'complement' => $request->complement
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput();
        }

        DB::commit();
        return view('employees.show', ['employee'=>$employee->load('address')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return void
     */
    public function destroy(Employee $employee)
    {
        $address = $employee->address()->first();
        if ($address->count()) {
            $address->delete();
        }
        $employee->delete();
        $employees = Employee::paginate(10);
        return view('employees.index',['employees'=>$employees]);
    }

    /**
     * List employees by company.
     *
     * @param Company $company
     * @return void
     */
    public function filterByCompany(Company $company)
    {
        $employees = $company->employees()->with('address')->paginate(10);
        return view('employees.index',['employees'=>$employees]);
    }
}

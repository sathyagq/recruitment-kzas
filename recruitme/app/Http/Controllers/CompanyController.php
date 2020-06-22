<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index',['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        try
        {
            DB::beginTransaction();
            Company::create($request->all());
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput();
        }

        DB::commit();
        $companies = Company::paginate(10);
        return view('companies.index',['companies'=>$companies]);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company'=>$company->load('employees')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try
        {
            DB::beginTransaction();
            $company->update($request->all());
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput();
        }

        DB::commit();
        return view('companies.show', ['company' => $company->load('employees')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return void
     */
    public function destroy(Company $company)
    {
        $employees = $company->employees()->with('address')->get();
        if($employees->count()) {
          $employees->each(function ($employee) {
              $employee->address->delete();
              $employee->delete();
          });
        }
        $company->delete();
        $companies = Company::paginate(10);
        return view('companies.index',['companies'=>$companies]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;

class EmployeeController extends Controller
{

    /**
     * List employees of a company.
     *
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Company $company)
    {
        $employees = $company->employees()->with('address')->get();
        return response()->json($employees);
    }
}

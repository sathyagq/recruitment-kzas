<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CompanyController extends Controller
{
    /**
     * List all companies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companies = Company::get();
        return response()->json($companies);
    }
}

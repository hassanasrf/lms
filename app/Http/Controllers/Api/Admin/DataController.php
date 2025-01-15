<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Currency;
use App\Helpers\Constant;
use App\Models\ServiceType;
use App\Models\CompanyType;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class DataController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function getCompanyType()
    {
        try {
            $response = CompanyType::get(['id','name','is_active']);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getCustomerType()
    {
        try {
            $response = CustomerType::get(['id','name']);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getServiceType()
    {
        try {
            $response = ServiceType::get(['id','name']);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getCurrency()
    {
        try {
            $response = Currency::get(['id','name','code']);
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }
}

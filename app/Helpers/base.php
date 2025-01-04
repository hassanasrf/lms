<?php

if (! function_exists('successResponse')) {
    /**
     * @param $data
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    function successResponse($data = [], $message = '', $paginate = false, $code = null)
    {
        if ($paginate && is_object($data)) {
            $data = paginate($data);
        }

        $code = $code ?? getSuccessCode();

        $response = [
            'success' => true,
            'status_code' => $code,
            'message' => [$message],
            'data' => $data
        ];
        return response()->json($response, $code);
    }
}

if (! function_exists('errorResponse')) {
    /**
     * @param $error
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    function errorResponse($message, int $code = 400, $data = [])
    {
        $code = $code == 0 ? 400 : $code;
        $response = [
            'success' => false,
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];
        if ($code == 422) {
            $response['data'] = $data;
        }

        $code = is_int($code) && $code != 0 ? $code : 500;
        return response()->json($response, $code);
    }
}
if (! function_exists('paginate')) {
    /**
     * @param $data
     * @return array|null
     */
    function paginate($data = [])
    {

        $paginationArray = null;
        if ($data != null) {
            $paginationArray = array('list' => $data->items(), 'pagination' => []);
            $paginationArray['pagination']['total'] = $data->total();
            $paginationArray['pagination']['current'] = $data->currentPage();
            $paginationArray['pagination']['first'] = 1;
            $paginationArray['pagination']['last'] = $data->lastPage();
            if ($data->hasMorePages()) {
                if ($data->currentPage() == 1) {
                    $paginationArray['pagination']['previous'] = 0;
                } else {
                    $paginationArray['pagination']['previous'] = $data->currentPage() - 1;
                }
                $paginationArray['pagination']['next'] = $data->currentPage() + 1;
            } else {
                $paginationArray['pagination']['previous'] = $data->currentPage() - 1;
                $paginationArray['pagination']['next'] = $data->lastPage();
            }
            if ($data->lastPage() > 1) {
                $paginationArray['pagination']['pages'] = range(1, $data->lastPage());
            } else {
                $paginationArray['pagination']['pages'] = [1];
            }
            $paginationArray['pagination']['from'] = $data->firstItem();
            $paginationArray['pagination']['to'] = $data->lastItem();

            return $paginationArray;
        }
        return $paginationArray;
    }
}

/**
 * Get Success Code
 * @return int
 */
if (! function_exists('getSuccessCode')) {
    function getSuccessCode()
    {
        $code = 200;
        $trace = debug_backtrace();
        $caller = $trace[1]['function'] == 'successResponse' ? $trace[2]['function'] : $trace[1]['function'];

        if ($caller == 'store') {
            $code = 201;
        } elseif ($caller == 'destroy') {
            $code = 204;
        }
        return $code;
    }
}

<?php

/**
 * successResponse
 *
 * @param  mixed $message
 * @param  array $result
 * @param  int $code
 * @param  bool $paginate
 * @return \Illuminate\Http\JsonResponse
 */
if (! function_exists('successResponse')){
    function successResponse($message, $result = [], $code = null, $paginate = false)
    {
        $resultData = [];
        $resultData = $result;
        if ($paginate) {
            $resultData = paginate($result);
        }

        $code = $code ?? getSuccessCode();

        $response = [
            'success' => true,
            'status' => $code,
            'message' => is_array($message) === TRUE ? $message : [$message],
            'data' => $resultData
        ];
        return response()->json($response, $code);
    }
}

/**
 * errorResponse
 *
 * @param  mixed $error
 * @param  int $code
 * @param  array $data
 * @return \Illuminate\Http\JsonResponse
 */
if (! function_exists('errorResponse')){
    function errorResponse($error, $code = 400, $data = [])
    {
        if ($code == 'HY000') {
            $error = "Something went wrong";
        } elseif (is_string($error) && strpos($error, 'SQLSTATE[') !== false && app()->isProduction()) {
            // Log the exception
            \Log::error("Database Error $code: $error");

            $error = "A database error occurred. Please contact support.";
        }

        $response = [
            'success' => false,
            'status' => $code,
            'message' => is_array($error) == TRUE ? $error : [$error],
            'data' => [],
        ];

        $code = is_int($code) && $code !== 0 ? $code : 500;

        return response()->json($response, $code);
    }
}

/**
 * arrayExcept
 *
 * @param  array $array
 * @param  array $keys
 * @return array
 */
if (! function_exists('arrayExcept')){
    function arrayExcept($array, $keys){
        foreach($keys as $key){
            unset($array[$key]);
        }
        return $array;
    }
}

/**
 * paginate
 *
 * @param  array $data
 * @return array
 */
if (!function_exists('paginate')) {
    function paginate($data = [])
    {
        if (!$data) {
            return null;
        }

        $currentPage = $data->currentPage();

        return [
            'data' => $data->items(),
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current' => $currentPage,
                'first' => 1,
                'last' => $data->lastPage(),
                'previous' => ($currentPage > 1) ? $currentPage - 1 : null,
                'next' => ($currentPage < $data->lastPage()) ? $currentPage + 1 : null,
                // 'pages' => ($data->lastPage() > 1) ? range(1, $data->lastPage()) : [1],
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
        ];
    }
}

/**
 * getSuccessCode
 *
 * @return int
 */
if (!function_exists('getSuccessCode')) {
    function getSuccessCode()
    {
        $trace = debug_backtrace();
        $caller = $trace[1]['function'] == 'successResponse' ? $trace[2]['function'] : $trace[1]['function'];

        return match ($caller) {
            'store' => 201,
            'update', 'show' => 200,
            'destroy' => 204,
            default => 200,
        };
    }
}

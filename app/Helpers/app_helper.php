<?php 

if (!function_exists('sendSuccessResponse')) {

    function sendSuccessResponse(string $message, $data = null)
    {
        $response = [
            'error'   => false,
            'message' => $message,
            'code'    => 200
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, 200);
    }
}

if (!function_exists('sendErrorResponse')) {

    function sendErrorResponse(string $message, $code = 500, array $errorFields = null)
    {

        $response = [
            'error'   => true,
            'message' => $message,
            'code'    => $code,
        ];

        if (!is_null($errorFields)) {
            $response['data'] = $errorFields;
        }

        if ($code < 200 || !is_numeric($code) || $code > 599) {
            $code = 400;
            $response['code'] = $code;
        }

        return response()->json($response, $code);
    }
}
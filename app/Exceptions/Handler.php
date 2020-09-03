<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            // Define the response
            $response = [
                'status' => false,
                'code' => 20,
                'message' => 'Failed.',
                'data' => []
            ];

            if($exception instanceof ValidationException) {
                $response['code'] = error_code(ValidationException::class);
                $response['data'] = $exception->errors();
            }
            if($exception instanceof NotFoundHttpException) {
                $response['code'] = error_code(NotFoundHttpException::class);
//                $response['message'] = 'Không tồn tại đường dẫn này.';
            }
            if($exception instanceof MethodNotAllowedHttpException) {
                $response['code'] = error_code(MethodNotAllowedHttpException::class);
            }
            if($exception->getMessage() == 'Unauthenticated.') {
                $response['code'] = error_code('UNAUTHENTICATED');
            }



            // If this exception is an instance of HttpException
            if ($this->isHttpException($exception)) {
                // Grab the HTTP status code from the Exception
                $status = $exception->getStatusCode();
            }

            // Default response of 200
            $status = 200;

            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }

        if($exception instanceof AuthorizationException) {
            auth()->logout();
            $request->session()->flush();
            return redirect()->route('login')->withErrors('Bạn không có quyền truy cập vào : ' . $request->fullUrl());
        }

        return parent::render($request, $exception);

//        return parent::render($request, $exception);
    }
}

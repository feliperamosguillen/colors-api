<?php

namespace App\Exceptions;

use Throwable;
use Asm89\Stack\CorsService;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $response = $this->handleException($request, $exception);
        app(CorsService::class)->addActualRequestHeaders($response, $request);

        return $response;
    }

    public function handleException($request, Throwable $exception)
    {
        if($exception instanceof \Illuminate\Validation\ValidationException){
            $errors = $exception->validator->errors()->getMessages();
            return response()->json(['error' => $errors], 401);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('entity_not_found', 404);
        }

        if($exception instanceof JWTException) {
            return response()->json(['error' => 'not_valid_jwt_token'], 401);
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return response()->json(['error' => 'general_fail'], 500);
    }
}

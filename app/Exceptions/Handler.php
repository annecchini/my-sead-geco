<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //Fernando:
    // Refinindo método.
    // Para requests que tem header (Accept: application/json) retorna um json com erro.
    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException && $request->wantsJson()) {
            return response()->json(['error' => 'Resource not found!'], 404);
        }
        return parent::render($request, $e);
    }

    //Fernando:
    // Refinindo método. (Estava no tutorial mas não vi uso)
    // Para requests que tem header (Accept: application/json) um json com erro.
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return response()->json(['error' => 'Unauthenticated'], 401);
    // }
}

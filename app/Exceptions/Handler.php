<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

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
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {

                // not authorized
                case '403':
                    return \Response::view('admin.404',array(),403);
                    break;

                // not found
                case '404':
                    return \Response::view('admin.404',array(),404);
                    break;

                // internal error
                case '500':
                    return \Response::view('admin.404',array(),500);
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            return parent::render($request, $e);
        }
    }
}

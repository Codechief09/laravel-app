<?php

namespace App\Exceptions;

use Exception;
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function prepareResponse($request, Exception $e) {
        // 競合違反を条件分岐
        if($e instanceof ConflictHttpException) {
            return $this->invaildHttpRequest($request, $e);
        } 
        // 予約時間が競合していた場合エラーハンドリング
        if($e instanceof ReserveDuplicationException) {
            return redirect()->back()->withErrors('The selected time is already reserved or invalid.');
        }

        if($e instanceof DateException) {
            return redirect()->back()->withErrors('The selected date is invaild.');
        }

        return parent::prepareResponse($request, $e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}

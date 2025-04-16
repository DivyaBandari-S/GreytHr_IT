<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Exceptions\MethodNotFoundException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use PDOException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * Register exception handling.
     */
    public function register(): void
    {
        // $this->renderable(function (Throwable $exception, $request) {
        //     return $this->handleException($exception, $request);
        // });
    }

    /**
     * Custom global exception handler.
     */
    public function handleException(Throwable $exception, $request)
    {

        // Handle database and fatal errors
        if ($this->isDatabaseOrFatalError($exception)) {
            return response()->view('errors.500', [], 500);
        }

        // Handle 404 and HTTP-specific errors
        if ($exception instanceof MethodNotFoundException || $exception instanceof BadMethodCallException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }



    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Log::error('Exception Encountered : ' . $e->getMessage(), ['exception' => $e]);

        // Handle database and fatal errors
        if ($this->isDatabaseOrFatalError($e)) {
            return response()->view('errors.500');
        }

        // Handle 404 and HTTP-specific errors
        if ($e instanceof MethodNotFoundException || $e instanceof BadMethodCallException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $e);
    }

    /**
     * Determine if the exception is a database or fatal error.
     */
    protected function isDatabaseOrFatalError(Throwable $e): bool
    {
        return $e instanceof QueryException ||
            $e instanceof \PDOException ||
            $e instanceof ModelNotFoundException ||
            $e instanceof \Illuminate\Database\DeadlockException ||
            $e instanceof \Illuminate\View\ViewException ||
            $e instanceof \Symfony\Component\ErrorHandler\Error\FatalError ||
            $e instanceof  Builder ||
            $e instanceof Model;
    }
}

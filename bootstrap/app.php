<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $exception) {
            $exceptionMessage = $exception->getMessage();
            $messageKey = 'messages.' . ($exceptionMessage);
            $translatedMessage = trans($messageKey);
            $resultMessage = $messageKey == $translatedMessage ? $exceptionMessage : $translatedMessage;
            if (!empty($errors)) {
                $resultErrors = [];
                foreach ($errors as $error) {
                    $resultErrors[] = (is_array($error) ? implode(' ', $error) : $error);
                }

                $resultMessage = implode(' ', $resultErrors);
            }

            return new JsonResponse([
                'message' => $resultMessage,
                'errors' => $exception->errors(),
            ], 422);
        });
    })->create();

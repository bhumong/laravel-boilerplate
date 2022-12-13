<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::prefix('example')->group(function () {
    Route::get('{view}', function ($view) {
        try {
            return view('pages/example/' . $view);
        } catch (InvalidArgumentException $th) {
            throw new NotFoundHttpException();
        }
    });
});

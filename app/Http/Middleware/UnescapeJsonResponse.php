<?php

/*
JSONレスポンスのUnicodeエスケープを無効化する。実装時にはデバッグモードのみで使用できるようにする。
 */

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\JsonResponse;

class UnescapeJsonResponse {
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        // JSON以外はそのまま
        if (!$response instanceof JsonResponse) {
            return $response;
        }

        // エンコードオプションを追加して設定し直す
        $newEncodingOptions = $response->getEncodingOptions() | JSON_UNESCAPED_UNICODE;
        $response->setEncodingOptions($newEncodingOptions);

        return $response;
    }
}
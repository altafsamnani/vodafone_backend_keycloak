<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        try {
            $header = $request->header('authorization');

            [$clientId, $clientSecret] = $this->fetchTokensFromHeader($header);
        } catch (\InvalidArgumentException $exception) {
            return $this->errorResponse();
        }

        $oauthClient = DB::table('oauth_clients')
            ->where('id', $clientId)
            ->where('secret', $clientSecret)
            ->first();

        if (empty($oauthClient)) {
            return $this->errorResponse();
        }

        $request->request->add([
            'ip_address' => $request->server('SERVER_ADDR', ''),
            'client_id' => $oauthClient->id,
            'content_source' => $oauthClient->name
        ]);

        return $next($request);
    }

    private function fetchTokensFromHeader($authorization)
    {
        if ($authorization === null) {
            throw new \InvalidArgumentException('Authorization header not set');
        }

        if (! substr($authorization, 0, 6) === 'Basic ') {
            throw new \InvalidArgumentException('Header not valid.');
        }

        $authorization = base64_decode(str_replace('Basic ', '', $authorization));
        if (! strpos($authorization, ':')) {
            throw new \InvalidArgumentException('Token not in base64 format');
        }

        [$clientId, $clientSecret] = explode(':', $authorization);
        if ($clientId == null || $clientSecret == null) {
            throw new \InvalidArgumentException('Client ID or Client Secret not provided');
        }

        return [$clientId, $clientSecret];
    }

    private function errorResponse()
    {
        $error['error'] = 'Unauthorized, please use the header authorization with your basic authorization token';

        return response($error, 401)->header('content-type', 'application/json');
    }
}

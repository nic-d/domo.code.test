<?php

namespace App\Domain\Infrastructure\Controllers\Auth;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\ClientException;
use App\Domain\Infrastructure\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $client = new Client();
            $endpoint = $request->server('SERVER_ADDR');

            $oauthResponse = $client->post($endpoint . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('APP_CLIENT_ID'),
                    'client_secret' => env('APP_CLIENT_SECRET'),
                    'scope' => '*',
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                ],
            ]);

            $oauthBody = json_decode($oauthResponse->getBody()->getContents(), true);

            $meResponse = $client->get($endpoint . '/infrastructure/account', [
                'headers' => [
                    'Authorization' => sprintf('Bearer %s', $oauthBody['access_token']),
                    'Content-Type' => 'application/json',
                    'Accept' => 'applications/json',
                ],
            ]);

            $meBody = json_decode($meResponse->getBody()->getContents(), true);

            return $oauthBody;
        } catch (ClientException $e) {
            $body = json_decode($e->getResponse()->getBody()->getContents(), true);
            return response()->json($body, 401);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }
}

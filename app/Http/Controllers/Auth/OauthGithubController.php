<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class OauthGithubController
{
    public function callback()
    {
        $parametrs = [
            'client_id' => config()->get('services.github.client_id'),
            'client_secret' => config()->get('services.github.client_secret'),
            'redirect_uri' => route('oauthGithub'),
            'code' => request()->input('code')
        ];
        $url = 'https://github.com/login/oauth/access_token';

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post($url, $parametrs);

        if (!isset($response->json()['access_token'])) {
            return redirect()->route('authLogin');
        }

        $url = 'https://api.github.com/user';
        $userInfo = Http::withToken($response->json()['access_token'])->get($url);
        $userInfo = $userInfo->json();

        if (empty($userInfo['email'])) {
            $url = 'https://api.github.com/user/emails';
            $emailInfo = Http::withToken($response->json()['access_token'])->get($url);
            $userInfo['email'] = $emailInfo->json()[0]['email'];
        }


        $user = User::where('email', $userInfo['email'])->first();
        if (empty($user)) {
            $user = User::create([
                'name' => $userInfo['name'] ?? $userInfo['login'],
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['email'] . '_salt')
            ]);
        }

        Auth::login($user);
        return redirect()->route('admin');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class OauthGithubController
{
    public function callback()
    {
        $code = request()->input('code');
        $parametrs = [
            'client_id' => getenv('OAUTH_GITHUB_CLIENT_ID'),
            'client_secret' => getenv('OAUTH_GITHUB_CLIENT_SECRET'),
            'code' => $code,
            'redirect_uri' => route('oauthGithub'),
        ];
        $url = 'https://github.com/login/oauth/access_token';
        $urlGithub = $url . '?' . http_build_query($parametrs);

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post($url, $parametrs);

        if (!isset($response->json()['access_token'])) {
            return redirect()->route('authLogin');
        }

        $url = 'https://api.github.com/user';
        $userInfo = Http::withToken($response->json()['access_token'])->get($url);
        $userInfo = $userInfo->json();

//    $user = User::where('email', $userInfo['email'])->first();
        $user = User::where('name', $userInfo['login'])->first(); // Сделал так потму что нет ни имени ни логина у меня. Просто что бы заходило и выходило
        if (empty($user)) {
            $user = User::create([
                'name' => $userInfo['name'] ?? $userInfo['login'],
                'email' => $userInfo['email'] ?? '123@gmail.com',
                'password' => Hash::make($userInfo['email'] . '_salt')
            ]);
        }

        Auth::login($user);
        return redirect()->route('admin');
    }
}

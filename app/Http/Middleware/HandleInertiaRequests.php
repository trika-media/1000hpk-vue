<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'csrf_token' => csrf_token(),
            'app' => [
                'name' => config('app.name'),
                'const' => fn () => config('const'),
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'warning' => fn () => $request->session()->get('warning'),
                'danger' => fn () => $request->session()->get('danger'),
                'info' => fn () => $request->session()->get('info'),
            ],
            'auth' => [
                'user' => $request->user(),
                'avatar' => $request->user()?->avatarUrl,
                'mahasiswa' => $request->user()->mahasiswa ?? false,
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(protected UserRepository $userRepository) {}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|max:100',
            'password' => 'required|string|max:100',
        ], messages: [
            'email.required' => __('E-posta veya kullanıcı adını giriniz.'),
            'email.string' => __('Geçerli bir e-posta veya kullanıcı adı giriniz.'),
            'email.max' => __('Geçerli bir e-posta veya kullanıcı adı giriniz.'),
            'password.required' => __('Şifrenizi giriniz.'),
            'password.string' => __('Geçerli bir şifre giriniz.'),
            'password.max' => __('Geçerli bir şifre giriniz.'),
        ]);

        $user = $this->userRepository->findEmailOrUsername($data['email']);

        if (!$user) {
            return redirect()->back()->withInput()->withErrors(__('Girmiş olduğunuz bilgilere ait bir üyelik bulunamadı.'));
        }

        if (Auth::attempt(['email' => $user['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('auth.dashboard'));
        }

        return redirect()->back()->withInput()->withErrors(__('Giriş başarısız. Giriş bilgilerinizi kontrol edip tekrar deneyiniz.'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use App\Services\LogService;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RegisterController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository,
        protected LogService $logService
    ) {}


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepository->create($data);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('auth.dashboard');
        }
        catch (Throwable $e) {
            $this->logService->logError('Üyelik başarısız oldu.', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput()->withErrors(__('Üyelik işlemi başarısız oldu lütfen tekrar deneyiniz.'));
        }
    }
}

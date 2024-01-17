<?php

namespace User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Category\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use User\Http\Requests\ResetPasswordVerifyCodeRequest;
use User\Http\Requests\sendResetPasswordVerifyCodeRequest;
use User\Http\Requests\VerifyCodeRequest;
use User\Models\User;
use User\Repositories\UserRepo;
use User\Services\VerifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    private $repository;

    public function __construct(UserRepo $userRepo)
    {
        $this->repository = $userRepo;
    }


    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.passwords.email');
    }

    public function sendVerifyCodeEmail(sendResetPasswordVerifyCodeRequest $request)
    {
        // check if exists in database
        $user = $this->repository->findByEmail($request);

        if ($user && ! VerifyCodeService::has($user->id)){
            $user -> sendResetPasswordRequestNotification();
        }


        return view('User::Front.passwords.enter-verify-code');
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        // check if exists in database
        $user = resolve(UserRepo::class)->findByEmail($request);

        if($user && VerifyCodeService::check($user->id, $request->verify_code)){
           auth()->loginUsingId($user->id);
           return redirect() -> route('password.showResetForm');
        }

        return back()->withErrors(['verify_code' => 'کد وارد شده معتبر نمی باشد!']);

    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $user = User::whereEmail($notifiable->getEmailForVerification())->first();
            return (new MailMessage)
                ->subject('Xác minh email Tài Khoản News')
                ->line('Nhấp vào nút bên dưới để xác minh địa chỉ email của bạn.')
                ->action('Xác minh địa chỉ email', $url)
                ->view('emails.verify', compact('url','user'));
        });

        $this->registerPolicies();
        Passport::routes();
        //
    }
}

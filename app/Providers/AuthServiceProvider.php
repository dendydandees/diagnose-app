<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $app_name = config('app.name');

            return (new MailMessage)
                ->greeting("Hai")
                ->subject("[{$app_name}] ". Lang::get('Verify Email Address'))
                ->line("Terima kasih telah bergabung dengan {$app_name}. Untuk menyelesaikan pendaftaran, silakan klik tombol di bawah ini untuk memverifikasi akun Anda.")
                ->action(Lang::get('Verify Email Address'), $url)
                ->line(Lang::get('If you did not create an account, no further action is required.'));
        });
    }
}

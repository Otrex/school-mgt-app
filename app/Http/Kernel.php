<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // \App\Http\Middleware\ApiKeyMiddleware::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'api.key' => \App\Http\Middleware\ApiKeyMiddleware::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest.admin' => \App\Http\Middleware\RedirectIfAdminAuthenticated::class,
        'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
        'auth.community' => \App\Http\Middleware\AuthenticateCommunityMember::class,
        'check.portal.status' => \App\Http\Middleware\CheckPortalStatus::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'community.verified' => \App\Http\Middleware\CommunityMemberEmailIsVerified::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'check.payment.complete' => \App\Http\Middleware\CheckPaymentComplete::class,
        'auth.unauthorize' => \App\Http\Middleware\RedirectIfNotAuthenticated::class,
        'auth.role.super_admin' => \App\Http\Middleware\AuthRoleSuperAdmin::class,
        'auth.role.super.admin' => \App\Http\Middleware\AuthRoleSuperAdminOrAdmin::class,
        'auth.role.admin' => \App\Http\Middleware\AuthRoleAdmin::class,
        'guests' => \App\Http\Middleware\AuthenticateGuestForAllUser::class,
        'guest.community.member' => \App\Http\Middleware\AuthenticateGuestForCommunityMember::class,
        'deny.lock.lesson.access' => \App\Http\Middleware\DenyAccessToLockCourseSeries::class,
        'deny.access.test.page' => \App\Http\Middleware\RedirectIfGuestAccessTestPage::class,
        'exam.not.set' => \App\Http\Middleware\RedirectIfExamIdNotSet::class,
        'exam.notice.access' => \App\Http\Middleware\RedirectIfGuestAccessExamNoticePage::class,
        'seo' => \App\Http\Middleware\AddSeoDefaults::class,
    ];
}

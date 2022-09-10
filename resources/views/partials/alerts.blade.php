@if (session('success'))
<div class="alert alert-success">
    عملیات با موفقیت انجام شد
</div>
@endif

@if (session('failed'))
<div class="alert alert-danger">
    عملیات با شکست مواجه شد
</div>
@endif

@if (session('registered'))
<div class="alert alert-success">
    @lang('auth.your registration was successful')
</div>
@endif

@if (session('wronCredentials'))
<div class="alert alert-success">
    @lang('auth.user or password was wrong')
</div>
@endif

@if (session('emailHasVerified'))
<div class="alert alert-success">
    @lang('auth.email has verified')
</div>
@endif

@if (session('resetLinkSent'))
<div class="alert alert-success">
    @lang('auth.reset link sent')
</div>
@endif

@if (session('resetLinkFailed'))
<div class="alert alert-danger">
    @lang('auth.reset link failed')
</div>
@endif

@if (session('cantChangePassword'))
<div class="alert alert-danger">
    @lang('auth.cant change password')
</div>
@endif

@if (session('passwordChanged'))
<div class="alert alert-success">
    @lang('auth.password changed')
</div>
@endif

@if (session('magicLinkSent'))
<div class="alert alert-success">
    @lang('auth.magic link sent')
</div>
@endif

@if (session('invalidToken'))
<div class="alert alert-danger">
    @lang('auth.invalid token')
</div>
@endif

@if (session('cantSentCode'))
<div class="alert alert-danger">
    @lang('auth.cant sent code')
</div>
@endif

@if (session('invalidCode'))
<div class="alert alert-danger">
    @lang('auth.invalid code')
</div>
@endif

@if (session('twoFactorActivated'))
<div class="alert alert-success">
    @lang('auth.two factor acticvated')
</div>
@endif

@if (session('twoFactorDeactivated'))
<div class="alert alert-success">
    @lang('auth.twoFactorDeactivated')
</div>
@endif

@if (session('codeResent'))
<div class="alert alert-success">
    @lang('auth.codeResent')
</div>
@endif

<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4">
                        <a href="{{ route('index') }}" class="d-flex align-items-center w-auto">
                            <img src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="p-3 email-verify-notice-card">
                                <div class="bold mb-3">Verify Your Email Address</div>
                                <div class="email-verify-message">
                                    Thank you signing up to join our community membership training. To get started, please verify your email address by clicking
                                    on the link we just emailed to you. If you didn't receive the email, please kindly click on the button below to send another email.
                                </div>
                                <div class="mt-3">
                                    <form wire:submit.prevent="resendVerificationLink">
                                        <button class="btn btn-dark btn-sm w-100">
                                            <span wire:loading.remove wire:target="resendVerificationLink">RESEND VERIFICATION EMAIL</span>
                                            <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="resendVerificationLink"></div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="my-1 text-center">
                                @livewire('auth.community-member-logout', ['type' => 'verify'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    window.addEventListener('success', event => {
        iziToast.success({
            title: 'Success!',
            message: event.detail,
            position: 'topRight'
        });
    });
</script>
@endpush
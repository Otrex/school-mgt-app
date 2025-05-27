<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Reset Password</h2>
        </div>
    </div>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="text-center my-3">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="container p-5">
            <div class="row mt-2" >
                <div class="col-lg-4 m-auto mt-lg-0">
                    <form wire:submit.prevent="resetPassword" class="php-email-form">
                    <input type="hidden" wire:model="token">
                        <input type="hidden" wire:model="email">
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" wire:model.defer="password" id="password" placeholder="Password" >
                            <x-inline-error name="password" />
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" wire:model.defer="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" style="margin-bottom: 40px;">
                            Reset Password
                                <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="resetPassword"></div>
                            </button><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
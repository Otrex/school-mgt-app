<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Login</h2>
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
                    <form wire:submit.prevent="login" class="php-email-form">
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" wire:model.defer="login_id" id="email" placeholder="Reg No/Email" >
                            <x-inline-error name="login_id" />
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" wire:model.defer="password" id="password" placeholder="Password">
                            <x-inline-error name="password" />
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" style="margin-bottom: 40px;">
                                Login
                                <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="login"></div>
                            </button><br>
                            <small><a class="link" href="{{ route('forgot.password') }}">Forget Password</a></small>
                            <br>
                            <small><a class="link" href="{{ route('communities.register') }}">Sign up as a community member</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
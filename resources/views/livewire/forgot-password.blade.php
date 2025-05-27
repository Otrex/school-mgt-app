<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Forget Password</h2>
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
                    <form wire:submit.prevent="sendLink" class="php-email-form">
                        <div class="form-group mt-3">
                            <label style="margin-bottom: 10px;">Enter your registered email below</label>
                            <input type="text" class="form-control" wire:model.defer="email" id="email" placeholder="Email" >
                            <x-inline-error name="email" />
                        </div>
                       
                        <div class="text-center mt-2">
                            <button type="submit" style="margin-bottom: 40px;">
                            Send Link
                                <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="sendLink"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
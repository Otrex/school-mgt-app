<div class="container">
    @section('title')
        Login - Blip School Admin
    @endsection
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4">
                        <a href="{{ route('index') }}" class="d-flex align-items-center w-auto">
                            <img src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Admin Login</h5>
                            </div>
                            <form wire:submit.prevent="login" class="row g-3">
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" wire:model.defer="email" class="form-control" id="email">
                                    </div>
                                    <x-inline-error name="email" />
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                                        <input type="password" wire:model.defer="password" class="form-control" id="yourPassword">
                                    </div>
                                    <x-inline-error name="password" />
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <span wire:loading.remove wire:target="login">Login</span>
                                        <div wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="login" role="status"></div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    window.addEventListener('error', event => {
        iziToast.error({
            title: 'Error!',
            message: event.detail,
            position: 'topRight'
        });
    });
</script>
@endpush
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Club Membership Registeration</h2>
        </div>
    </div>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="text-center my-3">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="container">
            <div class="row mt-2">
                <div class="col-lg-4 m-auto mt-lg-0">
                    <form wire:submit.prevent="register" role="form" class="php-email-form">
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" wire:model.defer="first_name" id="first_name" placeholder="First Name">
                            <x-inline-error name="first_name" />
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" wire:model.defer="last_name" id="last_name" placeholder="Last Name">
                            <x-inline-error name="last_name" />
                        </div>
                        <div class="form-group mt-3">
                            <select wire:model.defer="gender" id="" class="form-control form-select">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <x-inline-error name="gender" />
                        </div>

                        <div class="form-group mt-3">
                            <select wire:model="state" id="" class="form-control form-select">
                                <option value="">State</option>
                                @forelse ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @empty
                                <option value="">No state available</option>
                                @endforelse
                            </select>
                            <x-inline-error name="state" />
                        </div>

                        <div class="form-group mt-3">
                            <select wire:model="local_government" id="" class="form-control form-select">
                                <option value="">Local Government</option>
                                @forelse ($local_governments as $lga)
                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                @empty
                                <option value="">No LGA available</option>
                                @endforelse
                            </select>
                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                            <x-inline-error name="local_government" />
                        </div>

                        <div class="form-group mt-3">
                            <select wire:model="town" id="" class="form-control">
                                <option value="">Town</option>
                                @forelse ($towns as $town)
                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                                @empty
                                <option value="">No town available </option>
                                @endforelse
                            </select>
                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                            <x-inline-error name="town" />
                        </div>

                        <div class="form-group mt-3">
                            <select wire:model="school" id="" class="form-control">
                                <option value="">School</option>
                                @forelse ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @empty
                                <option value="">No school available </option>
                                @endforelse
                            </select>
                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="town" role="status"></div>
                            <x-inline-error name="school" />
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" wire:model.defer="home_address" id="home_address" placeholder="Home Address">
                            <x-inline-error name="home_address" />
                        </div>
                        <div class="form-group mt-3">
                            {{-- <label for="">Password <sup class="text-danger">*</sup></label> --}}
                            <input type="password" class="form-control" wire:model.defer="password" id="password" placeholder="Password">
                            <x-inline-error name="password" />
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" wire:model.defer="password_confirmation" id="confirm_password" placeholder="Confirm Password">
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" wire:model.defer="privacy_policy">
                            <label style="margin-left: 10px; font-size: 12px; color: #5e5c5c;">
                                <span>I have read and agree to the</span> <a href="{{ route('privacy.policy') }}" class="link">privacy policy</a>
                            </label>
                        </div>
                        <x-inline-error name="privacy_policy" />
                        <div class="text-center mt-2">
                            <button type="submit">
                                Register
                                <div wire:loading.class="spinner-grow spinner-grow-sm text-light" wire:target="register"></div>
                            </button>
                        </div>
                    </form>
                    {{-- <small class="d-block text-center mt-5">Fields mark <sup class="text-danger">*</sup> are required</small> --}}
                </div>
            </div>
        </div>
    </section>
</main>


<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Communities Membership Registration</h2>
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
                            <input type="text" class="form-control" wire:model.defer="email" id="email" placeholder="Email">
                            <x-inline-error name="email" />
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" wire:model.defer="phone" id="phone" placeholder="Phone Number">
                            <x-inline-error name="phone" />
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
                                <optgroup label="Town">
                                    @forelse ($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                    @empty
                                    <option value="">No town/tertiary institution available </option>
                                    @endforelse
                                </optgroup>
                                <optgroup label="Tertiary Institution">
                                    @forelse ($tertiary_institutions as $tertiary_institution)
                                    <option value="{{ $tertiary_institution->id }}">{{ $tertiary_institution->name }}</option>
                                    @empty
                                    <option value="">No tertiary institution available </option>
                                    @endforelse
                                </optgroup>
                            </select>
                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                            <x-inline-error name="town" />
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="is_tertiary_institution" wire:model.defer="is_tertiary_institution">
                            <label for="is_tertiary_institution" style="margin-left: 10px; font-size: 12px; color: #5e5c5c;">
                                <span>Tick the box if you selected a tertiary institution</span>
                            </label>
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
                        <div class="form-group mt-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model.defer="ref_code" 
                                id="referrer_code" 
                                value="{{$ref_code}}" 
                                placeholder="(Optional) Referral Code " 
                            >
                            <x-inline-error name="referrer_code" />
                        </div>

                        <script> 
                        window.addEventListener("DOMContentLoaded", function () {
                            document.querySelector("#referrer_code").value = new URL(location.href).searchParams.get('code') || '';
                        })
                        </script>
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
                </div>
            </div>
        </div>
    </section>
</main>





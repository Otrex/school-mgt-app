<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Member</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.communities') }}">All Member</a></li>
                <li class="breadcrumb-item active">Add New Member</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Membership Form</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="first_name" class="form-control">
                                    <x-inline-error name="first_name" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="last_name" class="form-control">
                                    <x-inline-error name="last_name" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" wire:model.defer="email" class="form-control">
                                    <x-inline-error name="email" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="phone_number" class="form-control">
                                    <x-inline-error name="phone_number" />
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model="gender" id="male" value="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model="gender" id="female" value="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <x-inline-error name="gender" />
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="state">
                                        <option value="">--Select--</option>
                                        @forelse ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @empty
                                        <option value="">No state available</option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="state" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Local Government</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="local_government" aria-label="Default select example">
                                        <option value="">--Select--</option>
                                        @forelse ($local_governments as $lga)
                                        <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                        @empty
                                        <option value="">No LGA available</option>
                                        @endforelse
                                    </select>
                                    <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                                    <x-inline-error name="local_government" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Town</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="town">
                                        <optgroup label="Town">
                                            @forelse ($towns as $town)
                                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                                            @empty
                                            <option value="">No town available </option>
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
                            </div>

                            <div class="row mb-3">
                                <label for="home_address" class="col-sm-2 col-form-label">Is Tertiary Institution</label>
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" id="is_tertiary_institution" wire:model="is_tertiary_institution">
                                        <span for="is_tertiary_institution" style="margin-left: 10px; font-size: 12px; color: #5e5c5c;">
                                            <span>Tick the box if you selected a tertiary institution</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Home Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" wire:model.defer="home_address" style="height: 100px"></textarea>
                                    <x-inline-error name="home_address" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add New Student" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
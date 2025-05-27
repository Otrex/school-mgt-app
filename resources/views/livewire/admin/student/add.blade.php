<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.students') }}">All Students</a></li>
                <li class="breadcrumb-item active">Add New Student</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Form</h5>
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
                                        <option value="">--Select--</option>
                                        @forelse ($towns as $town)
                                        <option value="{{ $town->id }}">{{ $town->name }}</option>
                                        @empty
                                        <option value="">No town available </option>
                                        @endforelse
                                    </select>
                                    <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="local_government" role="status"></div>
                                    <x-inline-error name="town" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">School</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="school">
                                        <option value="">--Select--</option>
                                        @forelse ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @empty
                                        <option value="">No school available </option>
                                        @endforelse
                                    </select>
                                    <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="town" role="status"></div>
                                    <x-inline-error name="school" />
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
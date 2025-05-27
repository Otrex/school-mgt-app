<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $user->fullname }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.students') }}">All Student</a></li>
                <li class="breadcrumb-item active">{{ $user->fullname }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex text-center flex-column align-items-center">
                        @if (!empty($user->image))
                        <img src="{{ is_url($user->image) ? $user->image : asset("storage/avatar/".$user->image) }}" alt="Profile" class="rounded-circle">
                        @else
                        <div class="user-word-avatar">
                            {{ $user->first_name[0]."".$user->last_name[0] }}
                        </div>
                        @endif
                        <h2>{{ (strlen($user->fullname) >= 17) ? $user->first_name[0].". ".$user->last_name : $user->fullname }}</h2>
                        <h3>{{ $user->reg_no }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Student</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->first_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->last_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($user->gender) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->phone ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Reg. No</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->reg_no }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">State</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->state }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Local Government</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->local_government }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Town</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->town }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">School</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->school }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->home_address }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.first_name" type="text" class="form-control" id="first_name">
                                            <x-inline-error name="user.first_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.last_name" type="text" class="form-control" id="last_name">
                                            <x-inline-error name="user.last_name" />
                                        </div>
                                    </div>

                                    <fieldset class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="user.gender" id="gridRadios1" value="male">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="user.gender" id="gridRadios2" value="female">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Female
                                                </label>
                                            </div>
                                            <x-inline-error name="user.gender" />
                                        </div>
                                    </fieldset>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.phone" type="text" class="form-control" id="Phone">
                                            <x-inline-error name="user.phone" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.email" type="text" class="form-control" id="Email">
                                            <x-inline-error name="user.email" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">States</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.state_id">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="user.state_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.local_government_id">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="user.state" role="status"></div>
                                            <x-inline-error name="user.local_government_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="town" class="col-md-4 col-lg-3 col-form-label">Town</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.town_id">
                                                <option value="">--Select--</option>
                                                @forelse ($towns as $town)
                                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                                                @empty
                                                <option value="">No town available </option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="user.local_government" role="status"></div>
                                            <x-inline-error name="user.town_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="school" class="col-md-4 col-lg-3 col-form-label">School</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.school_id">
                                                <option value="">--Select--</option>
                                                @forelse ($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                                @empty
                                                <option value="">No school available </option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="user.town" role="status"></div>
                                            <x-inline-error name="user.school_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="home_address" class="col-md-4 col-lg-3 col-form-label">Home Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea wire:model.defer="user.home_address" type="text" class="form-control" id="home_address"></textarea>
                                            <x-inline-error name="user.home_address" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="save" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
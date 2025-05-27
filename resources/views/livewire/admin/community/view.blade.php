<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $member->fullname }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.communities') }}">All Member</a></li>
                <li class="breadcrumb-item active">{{ $member->fullname }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex text-center flex-column align-items-center">
                        @if (!empty($member->image))
                        <img src="{{ is_url($member->image) ? $member->image : asset("storage/avatar/".$member->image) }}" alt="Profile" class="rounded-circle">
                        @else
                        <div class="user-word-avatar">
                            {{ $member->first_name[0]."".$member->last_name[0] }}
                        </div>
                        @endif
                        <h2>{{ (strlen($member->fullname) >= 17) ? $member->first_name[0].". ".$member->last_name : $member->fullname }}</h2>
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

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Referrals</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Referral Code</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->referrer_code }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->first_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->last_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($member->gender) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">State</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->state }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Local Government</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->local_government }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Town</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->town }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $member->home_address }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.first_name" type="text" class="form-control" id="first_name">
                                            <x-inline-error name="member.first_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.last_name" type="text" class="form-control" id="last_name">
                                            <x-inline-error name="member.last_name" />
                                        </div>
                                    </div>

                                    <fieldset class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="member.gender" id="gridRadios1" value="male">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="member.gender" id="gridRadios2" value="female">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Female
                                                </label>
                                            </div>
                                            <x-inline-error name="member.gender" />
                                        </div>
                                    </fieldset>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.phone" type="text" class="form-control" id="Phone">
                                            <x-inline-error name="member.phone" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="member.email" type="text" class="form-control" id="Email">
                                            <x-inline-error name="member.email" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">States</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.state_id">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="member.state_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.local_government_id">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="member.state" role="status"></div>
                                            <x-inline-error name="member.local_government_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="town" class="col-md-4 col-lg-3 col-form-label">Town</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="member.town_id">
                                                @if ($member->is_tertiary_institution)
                                                <optgroup label="Tertiary Institution">
                                                    @forelse ($tertiary_institutions as $tertiary_institution)
                                                    <option value="{{ $tertiary_institution->id }}">{{ $tertiary_institution->name }}</option>
                                                    @empty
                                                    <option value="">No tertiary institution available </option>
                                                    @endforelse
                                                </optgroup>
                                                @else
                                                <optgroup label="Town">
                                                    @forelse ($towns as $town)
                                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                                    @empty
                                                    <option value="">No town available </option>
                                                    @endforelse
                                                </optgroup>
                                                @endif
                                            </select>
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="member.local_government" role="status"></div>
                                            <x-inline-error name="member.town_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="home_address" class="col-md-4 col-lg-3 col-form-label">Is Tertiary Institution</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" id="is_tertiary_institution" wire:model="member.is_tertiary_institution">
                                                <span for="is_tertiary_institution" style="margin-left: 10px; font-size: 12px; color: #5e5c5c;">
                                                    <span>Tick the box if you selected a tertiary institution</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="home_address" class="col-md-4 col-lg-3 col-form-label">Home Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea wire:model.defer="member.home_address" type="text" class="form-control" id="home_address"></textarea>
                                            <x-inline-error name="member.home_address" />
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


                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-edit">

                                <div>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Verified</th>
                                                <th>Honored</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($member->referrals as $referral)
                                                <tr>
                                                    <td>{{ $referral->id }}</td>
                                                    <td>{{ $referral->referred->fullname }}</td>
                                                    <td>{{ $referral->referred->email }}</td>
                                                    <td>{{ $referral->referred->phone }}</td>
                                                    <td>{{ $referral->referred->email_verified_at != null ? 'Yes' : 'No' }}</td>
                                                    {{-- <td>{{ $referral->honored ? 'Yes' : 'No' }}</td> --}}
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input disabled class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $referral->honoured == 1 ? 'checked' : 'xc' }}>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Profile</button>
                            </li>

                            @if (is_superAdmin() || is_admin())
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Portal</button>
                            </li>
                            @endif

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($admin->fullname) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Level</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->level }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($admin->status) }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="updateProfile">
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="admin.first_name" type="text" class="form-control" id="first_name">
                                            <x-inline-error name="admin.first_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="admin.last_name" type="text" class="form-control" id="last_name">
                                            <x-inline-error name="admin.last_name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="admin.email" type="email" class="form-control" id="email">
                                            <x-inline-error name="admin.email" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="updateProfile" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            @if (is_superAdmin() || is_admin())
                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-settings">
                                <!-- Settings Form -->
                                <div class="alert alert-info fade show my-2" style="font-size: 12px; padding: 10px;" role="alert">
                                    <i class="bi bi-info-circle me-1"></i>
                                    This section is for managing the student registeration portal.
                                    {!! is_null($portal) ?
                                        'Click <a href="javascript:void(0);"
                                        wire:click="createPortal">Here</a> <span wire:loading.class="spinner-border spinner-small text-dark" wire:target="createPortal"></span>
                                        to create a registeration portal if none has been created.'
                                        : ''
                                    !!}
                                </div>
                                @if (!is_null($portal))
                                <form wire:submit.prevent="updatePortal">
                                    <div class="row mb-3">
                                        <label for="start_date" class="col-md-4 col-lg-3 col-form-label">Start Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="portal.start_date" type="date" class="form-control" id="start_date">
                                            <x-inline-error name="start_date" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="end_date" class="col-md-4 col-lg-3 col-form-label">End Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="portal.end_date" type="date" class="form-control" id="end_date">
                                            <x-inline-error name="end_date" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="flexSwitchCheckChecked" class="col-md-4 col-lg-3">Portal Status</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" wire:model.defer="portal.is_on" type="checkbox" id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">{{ ($portal->is_on) ? 'On; Turn Off' : 'Off; Turn On' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="updatePortal" />
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                            @endif

                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form wire:submit.prevent="passwordReset">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.lazy="old_password" type="password" class="form-control" id="currentPassword">
                                            <x-inline-error name="old_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.lazy="new_password" type="password" class="form-control" id="newPassword">
                                            <x-inline-error name="new_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.lazy="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Reset Password" target="passwordReset" />
                                        </div>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex text-center flex-column align-items-center">
                        @livewire('components.student-avatar')
                        <h2>{{ (strlen(auth()->user()->fullname) >= 17) ? auth()->user()->first_name[0].". ".auth()->user()->last_name : auth()->user()->fullname }}</h2>
                        <h3>{{ auth()->user()->reg_no }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  0 }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                                    <span class="tab-icon bi bi-house-fill"></span>
                                    <span class="tab-title">Overview</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                                    <span class="tab-icon bi bi-pencil"></span>
                                    <span class="tab-title">Edit Profile</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">
                                    <span class="tab-icon bi bi-lock-fill"></span>
                                    <span class="tab-title">Change Password</span>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">
                                    <span class="tab-icon bi bi-image-fill"></span>
                                    <span class="tab-title">Change Profile Image</span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->fullname }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">School</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->school }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Session</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->session->session }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($user->gender ?? 'None') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Reg. No.</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->reg_no }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->phone ?? 'None' }}</div>
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

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.phone" type="text" class="form-control" id="phone">
                                            <x-inline-error name="user.phone" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.email" type="email" class="form-control" id="email">
                                            <x-inline-error name="user.email" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="school" class="col-md-4 col-lg-3 col-form-label">School</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="user.school" type="text" class="form-control" id="school">
                                            <x-inline-error name="user.school" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="local_government" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.local_government" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $lga)
                                                <option value="{{ $lga->name }}">{{ $lga->name }}</option>
                                                @empty
                                                <option value="">No LGA available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="user.local_government" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="town" class="col-md-4 col-lg-3 col-form-label">Town</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="user.town">
                                                <option value="">--Select--</option>
                                                @forelse ($towns as $town)
                                                <option value="{{ $town->name }}">{{ $town->name }}</option>
                                                @empty
                                                <option value="">No town available </option>
                                                @endforelse
                                            </select>
                                            <div style="position: absolute;" wire:loading.class="spinner-border spinner-border-sm text-dark" wire:target="user.local_government" role="status"></div>
                                            <x-inline-error name="user.town" />
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
                                        <div class="col-md-4 col-lg-3"></div>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="save" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form wire:submit.prevent="passwordReset">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="old_password" type="password" class="form-control" id="currentPassword">
                                            <x-inline-error name="old_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="new_password" type="password" class="form-control" id="newPassword">
                                            <x-inline-error name="new_password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="new_password_confirmation" type="password" class="form-control" id="renewPassword">
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

                            <div class="tab-pane fade pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="profile-change-password">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-lg-12" wire:ignore>
                                        <form wire:submit.prevent="changeProfileImage">
                                            <div class="display-picture text-center">
                                                <label for="image" class="btn btn-secondary btn-sm mt-2 image-upload-box" id="img-add-btn">
                                                    <span style="font-size: 1.8em;" class="bi bi-image-fill"></span>
                                                    <div>Touch/Click to add profile image</div>
                                                </label>
                                                <input type="file" class="profile-image form-control visually-hidden" id="image" name="image">
                                            </div>
                                            <div class="crop-wrapper text-center">
                                                <div class="image-crop"></div>
                                                <button type="button" class="btn btn-success btn-sm" id="change">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm remove" id="change">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <div class="text-center cropped-image">
                                                <img src="" id="preview"><br>
                                                <input type="hidden" id="crop-img" wire:model="avatar">
                                                <button class="btn btn-primary my-3" id="submit">
                                                    <span>Set Avatar</span>
                                                    <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="changeProfileImage"></span>
                                                </button>
                                                <x-inline-error name="avatar" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ ucwords($admin->fullname) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">All Admin</a></li>
                <li class="breadcrumb-item active">Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <div class="user-word-avatar">
                            {{ $admin->first_name[0]."".$admin->last_name[0] }}
                        </div>
                        <h2>{{ ucwords($admin->fullname) }}</h2>
                        <h3>Level {{ $admin->level }}</h3>
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
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Admin</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Assign New Role</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            {{-- Admin Profile Detail --}}
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Admin Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($admin->first_name) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($admin->last_name) }}</div>
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
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">{{ $role_description }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($admin->status) }}</div>
                                </div>
                            </div>

                            {{-- Edit Admin Profile --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
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
                                        <label for="level" class="col-md-4 col-lg-3 col-form-label">Level</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="admin.level" id="level">
                                                <option value="">--Select--</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            <x-inline-error name="admin.level" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="admin.status" id="status">
                                                <option value="">--Select--</option>
                                                <option value="active">Active</option>
                                                <option value="suspended">Inactive</option>
                                                <option value="3">Three</option>
                                            </select>
                                            <x-inline-error name="admin.status" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <span class="col-md-4 col-lg-3"></span>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="save" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            {{-- Assign New Role --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="profile-edit">
                                <form wire:submit.prevent="assignNewRole">
                                    <div class="row mb-3">
                                        <label for="level" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="role" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                                                @endforeach
                                            </select>
                                            <x-inline-error name="role" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <span class="col-md-4 col-lg-3"></span>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Assign Role" target="assignNewRole" />
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
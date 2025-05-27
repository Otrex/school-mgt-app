<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $town->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.towns') }}">All Town</a></li>
                <li class="breadcrumb-item active">{{ $town->name }}</li>
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
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Town</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Town Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $town->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">State of origin</div>
                                    <div class="col-lg-9 col-md-8">{{ $town->state}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">LGA of origin</div>
                                    <div class="col-lg-9 col-md-8">{{ $town->localGovernment->name }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="town.state">
                                                <option value="">--Select--</option>
                                                @forelse ($states as $state)
                                                <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @empty
                                                <option value="">No state available </option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="town.state" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">Local Government</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model="town.local_government_id">
                                                <option value="">--Select--</option>
                                                @forelse ($local_governments as $local_government)
                                                <option value="{{ $local_government->id }}">{{ $local_government->name }}</option>
                                                @empty
                                                <option value="">No local government available </option>
                                                @endforelse
                                            </select>
                                            <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                                            <x-inline-error name="town.local_government_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="town" class="col-md-4 col-lg-3 col-form-label">Town</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="town.name" type="text" class="form-control" id="town">
                                            <x-inline-error name="town.name" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="" class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-8">
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
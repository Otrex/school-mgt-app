<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $session->session }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sessions') }}">All Session</a></li>
                <li class="breadcrumb-item active">{{ $session->session }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-edit">Edit Session</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Session Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Session</div>
                                    <div class="col-lg-9 col-md-8">{{ $session->session }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Start Date</div>
                                    <div class="col-lg-9 col-md-8">{{ $session->start_date }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">End Date</div>
                                    <div class="col-lg-9 col-md-8">{{ $session->end_date }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Default</div>
                                    <div class="col-lg-9 col-md-8">{{ $session->default ? 'Yes' : 'No' }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="course-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="session" class="col-md-4 col-lg-3 col-form-label">Session</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="session.session" type="text" class="form-control" id="session">
                                            <x-inline-error name="session.session" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="start_date" class="col-md-4 col-lg-3 col-form-label">Start Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="session.start_date" type="date" class="form-control" id="start_date">
                                            <x-inline-error name="session.start_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="end_date" class="col-md-4 col-lg-3 col-form-label">End Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="session.end_date" type="date" class="form-control" id="end_date">
                                            <x-inline-error name="session.end_date" />
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Default</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="session.default" id="gridRadios1" value="1">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="session.default" id="gridRadios2" value="0">
                                                <label class="form-check-label" for="gridRadios2">
                                                    No
                                                </label>
                                            </div>
                                            <x-inline-error name="session.default" />
                                        </div>
                                    </fieldset>
                                    <div class="text-center">
                                        <x-button name="Save Changes" target="save" />
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
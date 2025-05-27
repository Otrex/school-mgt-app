<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Session</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sessions') }}">All Sessions</a></li>
                <li class="breadcrumb-item active">Add New Session</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Session Form</h5>

                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Session</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="session" class="form-control" placeholder="e.g {{ date('Y') }}/{{ date('Y') + 1 }}">
                                    <x-inline-error name="session" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Start Date</label>
                                <div class="col-sm-10">
                                    <input type="date" wire:model.defer="start_date" class="form-control">
                                    <x-inline-error name="start_date" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-10">
                                    <input type="date" wire:model.defer="end_date" class="form-control">
                                    <x-inline-error name="end_date" />
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Default</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model.defer="default" id="gridRadios1" value="1">
                                        <label class="form-check-label" for="gridRadios1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model.defer="default" id="gridRadios2" value="0">
                                        <label class="form-check-label" for="gridRadios2">
                                            No
                                        </label>
                                    </div>
                                    <x-inline-error name="default" />
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add New Session" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
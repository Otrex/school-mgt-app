<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Town</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.towns') }}">All Towns</a></li>
                <li class="breadcrumb-item active">Add New Town</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Town Form</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
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
                                <label for="inputText" class="col-sm-2 col-form-label">Local Government</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="local_government">
                                        <option value="">--Select--</option>
                                        @forelse ($local_governments as $local_government)
                                        <option value="{{ $local_government->id }}">{{ $local_government->name }}</option>
                                        @empty
                                        <option value="">No local government available</option>
                                        @endforelse
                                    </select>
                                    <div wire:loading.class="position-absolute spinner-border spinner-border-sm text-dark" wire:target="state" role="status"></div>
                                    <x-inline-error name="local_government" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Town</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="name" class="form-control">
                                    <x-inline-error name="name" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add Town" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
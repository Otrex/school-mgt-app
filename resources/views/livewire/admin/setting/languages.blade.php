<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Content Language</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add New Content Language</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Content Language Form</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="addContentLanguage">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Language</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="language" class="form-control">
                                    <x-inline-error name="language" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Disable Language</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="disable">
                                        <option value="">--Select--</option>
                                        <option value="0">True</option>
                                        <option value="1">False</option>
                                    </select>
                                    <x-inline-error name="disable" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add Content Language" target="addContentLanguage" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

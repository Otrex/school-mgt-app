<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Exam</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.exams') }}">All Exams</a></li>
                <li class="breadcrumb-item active">Add New Exam</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Exam Form</h5>

                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Language</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="language_id">
                                        <option value="">--Select language--</option>
                                        @forelse ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->language }}</option>
                                        @empty
                                        <option value="">No language(s) available</option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="language_id" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="course_id">
                                        <option value="">--Select course--</option>
                                        @forelse ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @empty
                                        <option value="">No course(s) available</option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="course_id" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Number of Questions</label>
                                <div class="col-sm-10">
                                    <input type="number" wire:model.defer="number_of_question" class="form-control" min="0">
                                    <x-inline-error name="number_of_question" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Exam Duration(min)</label>
                                <div class="col-sm-10">
                                    <input type="number" wire:model.defer="time_duration" class="form-control">
                                    <x-inline-error name="time_duration" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Instruction</label>
                                <div class="col-sm-10">
                                    <div>
                                        <textarea name="instruction" class="form-control" style="height: 100px;" wire:model="instruction"></textarea>
                                    </div>
                                    <x-inline-error name="instruction" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add New Exam" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
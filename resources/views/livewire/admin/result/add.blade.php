<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Result</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.results') }}">All Result</a></li>
                <li class="breadcrumb-item active">Add New Result</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Result for the {{ $session->session }} session</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="fetch">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="course" aria-label="Default select example">
                                        <option value="">--Select--</option>
                                        @forelse ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @empty
                                        <option value="">No course available</option>
                                        @endforelse
                                    </select>
                                    <x-inline-error name="course" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    {{-- <button class="btn btn-primary btn-sm">Submit</button> --}}
                                    <x-button name="Fetch" target="fetch" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
            
            @isset($students)
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <div class="alert alert-info fade show my-2" style="font-size: 12px; padding: 10px;" role="alert">
                            <i class="bi bi-info-circle me-1"></i>
                            For bulk upload of result, click on this <a href="javascript:void(0);" wire:click="exportTemplate">link</a>
                            <span wire:loading.class="spinner-border spinner-small text-dark" wire:target="exportTemplate"></span>
                            to download the result template and use the file upload field below.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Students</h5>
                            <div>
                                <form wire:submit.prevent="bulkUpload" >
                                    <div class="d-flex align-items-center">
                                        <input type="file" wire:model="result_sheet" class="form-control form-control-sm" id="result_sheet">
                                        <button class="bulk-result-upload-btn">
                                            <span wire:loading.remove class="bi bi-cloud-upload-fill" wire:target="bulkUpload"></span>
                                            <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="bulkUpload"></span>
                                        </button>
                                    </div>
                                    <x-inline-error name="result_sheet" />
                                </form>
                            </div>
                        </div>

                        <form wire:submit.prevent="submitResult">
                            <table class="table table-stripped">
                                <thead>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Reg No</th>
                                        <th scope="col">Session</th>
                                        <th scope="col">School</th>
                                        <th scope="col">Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $index => $student)
                                    <tr wire:key="{{ $student->id }}">
                                        <td>
                                            <input type="hidden" wire:model="students.{{ $index }}.fullname">
                                            {{ $student->fullname }}
                                        </td>
                                        <td>
                                            <input type="hidden" wire:model="students.{{ $index }}.reg_no">
                                            {{ $student->reg_no }}
                                        </td>
                                        <td>
                                            {{ $student->session->session }}
                                        </td>
                                        <td>
                                            <input type="hidden" wire:model="students.{{ $index }}.school">
                                            {{ $student->school }}
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" min="0" max="100" type="number" wire:model="students.{{ $index }}.score" id="">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <x-button name="Submit" target="submitResult" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            @endisset
        </div>
    </section>
</main><!-- End #main -->
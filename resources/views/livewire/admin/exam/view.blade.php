<main id="main" class="main">
    <div class="pagetitle">
        <h1>Exam for {{ ucwords($exam->course->name) }}</h1>
        <nav>
            <ol class="breadcrumb text-on-small">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.exams') }}">All Exam</a></li>
                <li class="breadcrumb-item active">Exam for {{ ucwords($exam->course->name) }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div wire:ignore class="modal fade modal-lg" id="modalForm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-md-12 mb-3">
                                <label for="question" class="bold">Question</label>
                                <div wire:ignore>
                                    <textarea name="edit_question" id="edit_question" wire:model="edit_question"></textarea>
                                </div>
                                <x-inline-error name="edit_question" />
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 mb-3">
                                <label for="question" class="bold">Option A</label>
                                <input type="text" class="form-control" wire:model="edit_option_a">
                                <x-inline-error name="edit_option_a" />
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 mb-3">
                                <label for="question" class="bold">Option B</label>
                                <input type="text" class="form-control" wire:model="edit_option_b">
                                <x-inline-error name="edit_option_b" />
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 mb-3">
                                <label for="question" class="bold">Option C</label>
                                <input type="text" class="form-control" wire:model="edit_option_c">
                                <x-inline-error name="edit_option_c" />
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 mb-3">
                                <label for="question" class="bold">Option D</label>
                                <input type="text" class="form-control" wire:model="edit_option_d">
                                <x-inline-error name="edit_option_d" />
                            </div>
                            <div class="col-sm-12 col-lg-12 col-md-12 mb-3">
                                <label for="question" class="bold">Correct Answer</label>
                                <input type="text" class="form-control" wire:model="edit_correct_answer">
                                <x-inline-error name="edit_correct_answer" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">
                            <span>Save</span>
                            <div wire:target="update" wire:loading.class="spinner-border spinner-border-sm text-light"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3" x-data="{ activeTab:  {{ $active_tab ?? 0 }} }">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Exam</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Add Exam Questions</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">All Exam Questions</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            {{-- Exam Overview Details --}}
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Exam Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Course</div>
                                    <div class="col-lg-9 col-md-8">{{ $exam->course->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Number Of Questions</div>
                                    <div class="col-lg-9 col-md-8">{{ $exam->number_of_question }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Time Duration</div>
                                    <div class="col-lg-9 col-md-8">{{ $exam->time_duration }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Is Available
                                        <span class="bi bi-question-circle-fill text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Availability of the exam to be taken by the students."></span>
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ ($exam->is_available) ? 'Yes' : 'No' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Instruction</div>
                                    <div class="col-lg-9 col-md-8">{{ $exam->instruction }}</div>
                                </div>
                            </div>

                            {{-- Edit Exam Form --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="exam-course-name" class="col-md-4 col-lg-3 col-form-label">Language</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="exam.course_contents_language_id" id="exam-course-name">
                                                <option value="">--Select language--</option>
                                                @forelse ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                                                @empty
                                                <option value="">No language(s) available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="exam.course_contents_language_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="exam-course-name" class="col-md-4 col-lg-3 col-form-label">Course</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="exam.course_id" id="exam-course-name">
                                                <option value="">--Select course--</option>
                                                @forelse ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @empty
                                                <option value="">No course(s) available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="exam.course_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="exam-number-of-question" class="col-md-4 col-lg-3 col-form-label">Number Of Questions</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="number" wire:model.defer="exam.number_of_question" class="form-control" id="exam-number-of-question">
                                            <x-inline-error name="exam.number_of_question" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="exam-time-duration" class="col-md-4 col-lg-3 col-form-label">Exam Duration(min)</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="number" wire:model.defer="exam.time_duration" class="form-control" id="exam-time-duration">
                                            <x-inline-error name="exam.time_duration" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="exam-instruction" class="col-md-4 col-lg-3 col-form-label">Instruction</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div>
                                                <textarea name="exam.instruction" class="form-control" style="height: 100px;" id="exam-instruction" wire:model="exam.instruction"></textarea>
                                            </div>
                                            <x-inline-error name="exam.instruction" />
                                        </div>
                                    </div>

                                    <fieldset class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Is Available</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model.lazy="exam.is_available" id="exam-is-available-true" value="1">
                                                <label class="form-check-label" for="exam-is-available-true">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model.lazy="exam.is_available" id="exam-is-available-false" value="0">
                                                <label class="form-check-label" for="exam-is-available-false">
                                                    No
                                                </label>
                                            </div>
                                            <x-inline-error name="exam.is_available" />
                                        </div>
                                    </fieldset>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3 col-form-label"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save Changes" target="save" />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Add Exam Questions --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2">
                                <form wire:submit.prevent="addQuestion">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-md-4 col-lg-3 col-form-label">Lesson</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="course_series_id">
                                                <option value="">--Select  Lesson --</option>
                                                @forelse ($lessons as $lesson)
                                                <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                                                @empty
                                                <option value="">No Lesson(s) available</option>
                                                @endforelse
                                            </select>
                                            <x-inline-error name="course_series_id" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-md-4 col-lg-3 col-form-label">
                                            Question Duration (sec)
                                            <span class="bi bi-question-circle-fill text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter the time limit (seconds) for answering this question, default is 60 seconds"></span>
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="number" wire:model.defer="question_duration" class="form-control">
                                            <x-inline-error name="question_duration" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="exam-question" class="col-md-4 col-lg-3 col-form-label">Question</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea name="question" id="question" wire:model="question"></textarea>
                                            </div>
                                            <x-inline-error name="question" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3 col-form-label"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Add Exam Question" target="addQuestion" />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- All Questions --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3">
                                <div class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Exam Questions</h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            There are a total of {{ $questions->count() }} questions for this exam.
                                        </div>
                                    </div>
                                    <div style="overflow-x: scroll !important;">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr style="border-bottom: 1px solid #eee;">
                                                    <th scope="col">Lesson</th>
                                                    <th scope="col">Question</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($questions as $questions)
                                                <tr wire:key="{{ $questions->id }}">
                                                    <td>{{ $questions->courseSeries->title ?? 'Lesson title' }}</td>
                                                    <td>
                                                        <span x-data="{ view: false }">
                                                            <a href="javascript:void(0)" @click="view = true" x-id="['delete-{{ $questions->id }}']">
                                                                view
                                                            </a>
                                                            <div :id="$id('delete-{{ $questions->id }}')">
                                                                <div class="modal-wrapper" x-show="view" x-cloak>
                                                                    <div class="modal-bg-wrapper">
                                                                        <div class="modal-bg"></div>
                                                                    </div>
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <div class="card" style="width: 50%;">
                                                                            <div class="card-body">
                                                                                <div class="d-flex justify-content-end align-items-center py-2">
                                                                                    <button @click="view = false" class="close-btn">
                                                                                        <i class="bi bi-x-circle-fill"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    {!! $questions->question !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex text-center">

                                                            <a href="{{ route('admin.exam.question.view', [$exam,$questions]) }}" style="margin-right: 10px;">
                                                            <span class="bi bi-eye-fill"></span>
                                                        </a>
                                                            <span x-data="{ modal: false }">
                                                                <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $questions->id }}']">
                                                                    <span class="bi bi-trash-fill text-danger"></span>
                                                                </a>
                                                                <div :id="$id('delete-{{ $questions->id }}')">
                                                                    <div class="modal-wrapper" x-show="modal" x-cloak>
                                                                        <div class="modal-bg-wrapper">
                                                                            <div class="modal-bg"></div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center justify-content-center">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-end align-items-center py-2">
                                                                                        <button @click="modal = false" class="close-btn">
                                                                                            <i class="bi bi-x-circle-fill"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="text-center">
                                                                                        <div class="modal-icon">
                                                                                            <div class="bi bi-trash"></div>
                                                                                        </div>
                                                                                        <div class="bold mt-2">You are about to delete this question.</div>
                                                                                        <div class="fs-12px">Are you sure?</div>
                                                                                        <div class="mt-3">
                                                                                            <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary" wire:click="delete({{ $questions->id }})">
                                                                                                Confirm
                                                                                                <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="delete"></span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7"><div class="text-center"><em>Exam question(s) not available</em></div></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', ()=>{
        ClassicEditor
        .create( document.querySelector( '#question' ), {
            ckfinder: {
                uploadUrl: "{{ route('image.upload').'?_token='.csrf_token() }}",
            }
        })
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('question', editor.getData());
            });
            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '300px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );
    });

    window.addEventListener('openModal', ()=>{
        ClassicEditor
        .create( document.querySelector( '#edit_question' ), {
            ckfinder: {
                uploadUrl: "{{ route('image.upload').'?_token='.csrf_token() }}",
            }
        })
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('edit_question', editor.getData());
            });
            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '300px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );
    });

    window.addEventListener('openModal', event => {
        $('#modalForm').modal('show');
    });

    window.addEventListener('closeModal', event => {
        $('#modalForm').modal('hide');
    });

    window.addEventListener('hidden.bs.modal', event => {
        ClassicEditor.create( document.querySelector( '#edit_question' ) )
        .then( editor => {
            editor.destroy().then( () => {
                console.log( 'Editor was destroyed' );
            } );
        } )
        .catch( error => {
            console.error( error );
        } );
        Livewire.emit('refresh');
    });
</script>
@endpush
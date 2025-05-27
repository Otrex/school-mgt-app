<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ ucwords($course->name) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">All Programs</a></li>
                <li class="breadcrumb-item active">{{ ucwords($course->name) }}</li>
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
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Program</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Add Lessons</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">All Lessons</button>
                            </li>
                        </ul>

                        {{-- Tab for course detail overview --}}
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <div>
                                    @if (!empty($course->image))
                                        <img src="{{ $course->image }}" class="img-fluid">
                                    @endif
                                </div>

                                <h5 class="card-title">Program Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $course->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Summary</div>
                                    <div class="col-lg-9 col-md-8">{!! $course->summary !!}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Category</div>
                                    <div class="col-lg-9 col-md-8">{{ $course->courseCategory->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Duration</div>
                                    <div class="col-lg-9 col-md-8">{{ $course->duration }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Bill Type</div>
                                    <div class="col-lg-9 col-md-8">{{ $course->bill_type }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Fee</div>
                                    <div class="col-lg-9 col-md-8">&#8358;{{ number_format($course->fee, 2) }}</div>
                                </div>
                            </div>

                            {{-- Tab for adding new course --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="course-edit">
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Program Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        @if (!empty($course->image))
                                        <img style="width: 100% !important;" src="{{ $course->image }}">
                                        @endif
                                        <form wire:submit.prevent="uploadNewImage">
                                            <div class="pt-2">
                                                @if (isset($image))
                                                <button class="btn btn-success btn-sm text-light">
                                                    <span>Click to upload image</span>
                                                    <i wire:loading.remove class="bi bi-check-circle" wire:target="uploadNewImage"></i>
                                                    <i wire:loading.class="spinner-border text-light" style="width: 15px; height:15px;" wire:target="uploadNewImage"></i>
                                                </button>
                                                @else
                                                <label for="image" class="btn btn-primary btn-sm text-light" title="Select Image File">
                                                    <span>Select Image</span>
                                                    <i wire:loading.remove class="bi bi-image" wire:target="image"></i>
                                                    <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="image"></i>
                                                </label>
                                                <input type="file" wire:model="image" class="d-none" id="image">
                                                @endif
                                                @if (!empty($course->image))
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" wire:click="removeImage" title="Remove course image">
                                                    <span>Remove Image</span>
                                                    <i wire:loading.remove class="bi bi-trash" wire:target="removeImage"></i>
                                                    <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="removeImage"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="save">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="course.name" type="text" class="form-control" id="name">
                                            <x-inline-error name="course.name" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="summary" class="col-md-4 col-lg-3 col-form-label">Summary</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea wire:model.defer="course.summary" class="form-control" name="summary" id="summary"></textarea>
                                            </div>
                                            <x-inline-error name="course.summary" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-md-4 col-lg-3 col-form-label">Duration</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" wire:model.defer="course.duration" class="form-control" placeholder="">
                                            <x-inline-error name="course.duration" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="category" class="col-md-4 col-lg-3 col-form-label">Category</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="course.course_category_id" id="category">
                                                <option value="">--Select--</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-inline-error name="course.course_category_id" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="bill_type" class="col-md-4 col-lg-3 col-form-label">Bill Type</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="course.bill_type" id="bill_type">
                                                <option value="">--Select--</option>
                                                <option value="Free">Free</option>
                                                <option value="Paid">Paid</option>
                                            </select>
                                            <x-inline-error name="course.bill_type" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fee" class="col-md-4 col-lg-3 col-form-label">Fee</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="course.fee" type="number" class="form-control" id="fee">
                                            <x-inline-error name="course.fee" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Save changes" target="save" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            {{-- Tab for adding new course lessons --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="course-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="addSeries">
                                    <div class="row mb-3">
                                        <label for="serial_no" class="col-md-4 col-lg-3 col-form-label">Serial No.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="serial_no" type="number" min="0" class="form-control" id="serial_no">
                                            <x-inline-error name="serial_no" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="title" type="text" class="form-control" id="title">
                                            <x-inline-error name="title" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="summary" class="col-md-4 col-lg-3 col-form-label">Summary</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div>
                                                <textarea wire:model.defer="summary" class="form-control" style="height: 70px;" name="summary" id="summary"></textarea>
                                            </div>
                                            <x-inline-error name="summary" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Add Lesson" target="addSeries" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            {{-- Tab for all course lessons --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="all-course-series">
                                <div class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Program Lessons</h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            There are a total of {{ $course_series->count() }} lessons.
                                        </div>
                                    </div>
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr style="border-bottom: 1px solid #eee;">
                                                <th scope="col">Serial No.</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Summary</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($course_series as $series)
                                            <tr wire:key="{{ $series->id }}">
                                                <td><x-table-data :name="$series->serial_no" /></td>
                                                <td><x-table-data :name="$series->title" /></td>
                                                <td><x-table-data :name="\Illuminate\Support\Str::words($series->summary, 17)" /></td>
                                                <td>
                                                    <div class="d-flex text-center">
                                                        <a href="{{ route('admin.course.lesson.view', [$course, $series]) }}" style="margin-right: 10px;">
                                                            <span class="bi bi-eye-fill"></span>
                                                        </a>
                                                        <span x-data="{ modal: false }">
                                                            <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $series->id }}']">
                                                                <span class="bi bi-trash-fill text-danger"></span>
                                                            </a>
                                                            <div :id="$id('delete-{{ $series->id }}')">
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
                                                                                    <div class="bold mt-2">You are about to delete this item.</div>
                                                                                    <div class="fs-12px">Are you sure?</div>
                                                                                    <div class="mt-3">
                                                                                        <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                                                        <button type="button" class="btn btn-primary" wire:click="delete({{ $series->id }})">
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
                                                <td colspan="4"><div class="text-center"><em>Program lessons not available</em></div></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', ()=>{
        ClassicEditor
        .create( document.querySelector( '#summary' ) )
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('course.summary', editor.getData());
            });
            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '300px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#content' ), {
            ckfinder: {
                uploadUrl: "{{ route('image.upload').'?_token='.csrf_token() }}",
            }
        } )
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('content', editor.getData());
            });
            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '500px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );
    });
</script>
@endpush
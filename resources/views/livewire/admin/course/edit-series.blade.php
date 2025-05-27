<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ ucwords($series->title) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">All Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.course.view', $course) }}">{{ ucwords($course->name) }}</a></li>
                <li class="breadcrumb-item active">{{ ucwords($series->title) }}</li>
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
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Program Lesson</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">Add Lesson Content</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">All Lesson Content</button>
                            </li>
                        </ul>

                        {{-- Tab for course detail overview --}}
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">
                                <h5 class="card-title">Program Lesson Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Serial No.</div>
                                    <div class="col-lg-9 col-md-8">{{ $series->serial_no }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">{!! $series->title !!}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Summary</div>
                                    <div class="col-lg-9 col-md-8">{{ $series->summary }}</div>
                                </div>
                            </div>

                            {{-- Tab for editing new course lessons --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="course-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="updateSeries">
                                    <div class="row mb-3">
                                        <label for="serial_no" class="col-md-4 col-lg-3 col-form-label">Serial No.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="series.serial_no" type="number" min="0" class="form-control" id="serial_no">
                                            <x-inline-error name="series.serial_no" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="series.title" type="text" class="form-control" id="title">
                                            <x-inline-error name="series.title" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="summary" class="col-md-4 col-lg-3 col-form-label">Summary</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div>
                                                <textarea wire:model.defer="series.summary" class="form-control" style="height: 70px;" name="summary" id="summary"></textarea>
                                            </div>
                                            <x-inline-error name="series.summary" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Update Series" target="updateSeries" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                            {{-- Tab for adding  lesson content --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 2 }" x-show.transition.in.opacity.duration.600="activeTab === 2" id="course-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="addSeriesContent">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Language</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="language">
                                            <option value="">--Select--</option>
                                            @foreach ($languages as $language)
                                            @if(!$language->disable == "0")
                                            <option value="{{ $language->id }}">{{ $language->language }}</option>
                                            @endif
                                            @endforeach
                                            </select>
                                    <x-inline-error name="language" />
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
                                    <div class="row mb-3">
                                        <label for="content" class="col-md-4 col-lg-3 col-form-label">Text Content</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea wire:model.defer="text_content" class="form-control" name="text_content" id="text_content"></textarea>
                                            </div>
                                            <x-inline-error name="text_content" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Video Content" class="col-md-4 col-lg-3 col-form-label">Video Link</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="video_content" type="text" class="form-control" id="video_content">
                                            <x-inline-error name="video_content" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Add Lesson Content" target="addSeriesContent" />
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 3 }" x-show.transition.in.opacity.duration.600="activeTab === 3" id="all-course-series">
                                <div class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">All Lesson Content</h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            There are a total of {{ $content->count() }} Lesson Content Languages.
                                        </div>
                                    </div>
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr style="border-bottom: 1px solid #eee;">
                                                <th scope="col">Language</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Summary</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content as $series_content)
                                            <tr wire:key="{{ $series_content->id }}">
                                            @if(empty($series_content->courseContentsLanguages->language))
                                                <td><x-table-data :name='"Has No Language" '/></td>
                                            @else
                                            <td><x-table-data :name="$series_content->courseContentsLanguages->language" /></td>
                                            @endif
                                                <td><x-table-data :name="$series_content->title" /></td>
                                                <td><x-table-data :name="\Illuminate\Support\Str::words($series_content->summary, 17)" /></td>
                                                <td>
                                                    <div class="d-flex text-center">
                                                        <a href="{{ route('admin.course.lesson.content.view', [$course, $series,$series_content]) }}" style="margin-right: 10px;">
                                                            <span class="bi bi-eye-fill"></span>
                                                        </a>
                                                        <span x-data="{ modal: false }">
                                                            <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $series_content->id }}']">
                                                                <span class="bi bi-trash-fill text-danger"></span>
                                                            </a>
                                                            <div :id="$id('delete-{{ $series_content->id }}')">
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
                                                                                        <button type="button" class="btn btn-primary" wire:click="delete({{ $series_content->id }})">
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
                                                <td colspan="4"><div class="text-center"><em>All lesson content not available</em></div></td>
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
        .create( document.querySelector( '#content' ), {
            ckfinder: {
                uploadUrl: "{{ route('image.upload').'?_token='.csrf_token() }}",
            }
        })
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('series.content', editor.getData());
            });
            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '500px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );
    });

    window.addEventListener('DOMContentLoaded', ()=>{
        ClassicEditor
        .create( document.querySelector( '#text_content' ), {
            ckfinder: {
                uploadUrl: "{{ route('image.upload').'?_token='.csrf_token() }}",
            }
        })
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('text_content', editor.getData());
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
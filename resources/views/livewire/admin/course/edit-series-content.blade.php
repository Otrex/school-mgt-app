<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ ucwords($series_content->title) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">All Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.course.view', $course) }}">{{ ucwords($course->name) }}</a></li>
                <li class="breadcrumb-item active">{{ ucwords($series->title) }}</li>
                <li class="breadcrumb-item active">{{ ucwords($series_content->title) }}</li>
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
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Lesson Content</button>
                            </li>
                        </ul>

                        {{-- Tab for all lesson content detail overview --}}
                        <div class="tab-content pt-2">
                        {{-- Tab for all lesson content --}}
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">

                                @if(!empty($series_content->video_content))
                                   <div>
                                         
                                         <iframe width="560" height="315" src="{{ $series_content->video_content}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                 </div>
                                    @endif

                                
                                <h5 class="card-title">All Lesson Content Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Language.</div>
                                    <div class="col-lg-9 col-md-8">
                                    @if(empty($series_content->courseContentsLanguages->language))
                                    Has No Language
                                    @else
                                        {{$series_content->courseContentsLanguages->language}}
                                    @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">
                                    {{ $series_content->title }}
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Summary</div>
                                    <div class="col-lg-9 col-md-8">
                                    {{ $series_content->summary }}
                                    </div>
                                </div>

                                <h5 class="card-title">Content</h5>
                                {!! $series_content->text_content !!}

                                
                            </div>

                            {{-- Tab for editing new program lessons --}}
                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="course-edit">
                                <!-- Profile Edit Form -->
                                <form wire:submit.prevent="updateSeriesContent">
                                <div class="row mb-3">
                                        <label for="language" class="col-md-4 col-lg-3 col-form-label">Language</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="series_content.course_contents_languages_id" id="category">
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
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model="series_content.title" type="text" class="form-control" id="title" >
                                            <x-inline-error name="title" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="summary" class="col-md-4 col-lg-3 col-form-label">Summary</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea wire:model.defer="series_content.summary" class="form-control" name="summary" id="summary"></textarea>
                                            </div>
                                            <x-inline-error name="course.summary" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="content" class="col-md-4 col-lg-3 col-form-label">Text Content</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea wire:model.defer="series_content.text_content" class="form-control" name="text_content" id="text_content"></textarea>
                                            </div>
                                            <x-inline-error name="text_content" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Video Content" class="col-md-4 col-lg-3 col-form-label">Video Link</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="series_content.video_content" type="text" class="form-control" id="video_content">
                                            <x-inline-error name="video_content" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-lg-3"></label>
                                        <div class="col-md-8 col-lg-9">
                                            <x-button name="Update changes" target="updateSeriesContent" />
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
                @this.set('series_content.text_content', editor.getData());
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


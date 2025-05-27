<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ ucwords($blog->title) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs') }}">All Blog</a></li>
                <li class="breadcrumb-item active">Blog</li>
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
                                <button class="nav-link" @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">Edit Blog</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show profile-overview" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.600="activeTab === 0" id="profile-overview">

                                <h5 class="card-title">Blog Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->title }}</div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Category</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->category }}</div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tags</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->tags ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Keywords</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->keywords ?? 'None' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Author</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->admin->fullname }}</div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Summary</div>
                                    <div class="col-lg-9 col-md-8">{{ $blog->summary }}</div>
                                </div> --}}

                                <div>
                                    @if (!is_null($blog->image))
                                    <img src="{{ !is_url($blog->image) ? asset("storage/blog/{$blog->image}") : $blog->image }}" class="img-fluid border" alt="Profile">
                                    @endif
                                </div>
                                <h5 class="card-title">Content</h5>
                                {!! $blog->content !!}
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" :class="{ 'active show': activeTab === 1 }" x-show.transition.in.opacity.duration.600="activeTab === 1" id="profile-edit">
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Blog Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        @if (!empty($blog->image))
                                        <img style="width: 100% !important;" src="{{ $blog->image }}">
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
                                                    <i wire:loading.class="spinner-border text-light" style="width: 15px; height:15px;" wire:target="image"></i>
                                                </label>
                                                <input type="file" wire:model="image" class="d-none" id="image">
                                                @endif
                                                @if (!empty($blog->image))
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" wire:click="removeImage" title="Remove blog image">
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
                                        <label for="blog-title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="blog.title" type="text" class="form-control" id="blog-title">
                                            <x-inline-error name="blog.title" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="blog_summary" class="col-md-4 col-lg-3 col-form-label">Summary</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea wire:model.defer="blog.summary" style="height: 100px;" class="form-control" id="blog_summary"></textarea>
                                            <x-inline-error name="blog.summary" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="blog_category" class="col-md-4 col-lg-3 col-form-label">Category</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" wire:model.defer="blog.category" id="blog_category" aria-label="Default select example">
                                                <option value="">--Select--</option>
                                                <option value="Event">Event</option>
                                                <option value="News">News</option>
                                            </select>
                                            <x-inline-error name="blog.category" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="blog_content" class="col-md-4 col-lg-3 col-form-label">Content</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div wire:ignore>
                                                <textarea wire:model.defer="blog.content" type="text" class="form-control" name="content" id="content"></textarea>
                                            </div>
                                            <x-inline-error name="blog.content" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="blog_tags" class="col-md-4 col-lg-3 col-form-label">Tags</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="blog.tags" type="text" class="form-control" id="blog_tags">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="blog_keywords" class="col-md-4 col-lg-3 col-form-label">Keywords</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input wire:model.defer="blog.keywords" type="text" class="form-control" id="blog_keywords">
                                        </div>
                                    </div>

                                    <fieldset class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Is Publish</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model.lazy="blog.is_publish" id="gridRadios1" value="1">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model.lazy="blog.is_publish" id="gridRadios2" value="0">
                                                <label class="form-check-label" for="gridRadios2">
                                                    No
                                                </label>
                                            </div>
                                            <x-inline-error name="blog.is_publish" />
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
                @this.set('blog.content', editor.getData());
            })
        } )
        .catch( error => {
            console.error( error );
        } );
    });
</script>
@endpush
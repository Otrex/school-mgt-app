<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs') }}">All Blogs</a></li>
                <li class="breadcrumb-item active">Add New Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Blog Form</h5>
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" wire:model="image" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="title" class="form-control" placeholder="Enter blog title">
                                    <x-inline-error name="title" />
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Summary</label>
                                <div class="col-sm-10">
                                    <textarea wire:model.defer="summary" style="height: 100px;" class="form-control" placeholder="Enter blog summary"></textarea>
                                    <x-inline-error name="summary" />
                                </div>
                            </div> --}}

                            {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select wire:model.defer="category" class="form-select">
                                        <option value="">--Select--</option>
                                        <option value="Event">Event</option>
                                        <option value="News">News</option>
                                    </select>
                                    <x-inline-error name="category" />
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <div wire:ignore>
                                        <textarea name="content" wire:model.defer="content" id="content" style="height: 100px"></textarea>
                                    </div>
                                    <x-inline-error name="content" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="tags" class="form-control" placeholder="Enter tags separated by comma e.g php, css">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="keywords" class="form-control" placeholder="Enter keywords separated by comma e.g tutorial, programming">
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Is Publish</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model="is_publish" id="gridRadios1" value="1">
                                        <label class="form-check-label" for="gridRadios1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model="is_publish" id="gridRadios2" value="0">
                                        <label class="form-check-label" for="gridRadios2">
                                            No
                                        </label>
                                    </div>
                                    <x-inline-error name="is_publish" />
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add New Blog" target="add" />
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
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
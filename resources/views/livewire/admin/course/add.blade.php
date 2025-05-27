<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add New Program</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">All Programs</a></li>
                <li class="breadcrumb-item active">Add New Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Program Form</h5>

                        <!-- General Form Elements -->
                        <form wire:submit.prevent="add">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="name" class="form-control">
                                    <x-inline-error name="name" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Summary</label>
                                <div class="col-sm-10">
                                    <div wire:ignore>
                                        <textarea name="summary" id="summary" wire:model="summary"></textarea>
                                    </div>
                                    <x-inline-error name="summary" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Duration</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="duration" class="form-control">
                                    <x-inline-error name="duration" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model="category">
                                        <option value="">--Select--</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-inline-error name="category" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Sub Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="sub_category">
                                        <option value="">--Select--</option>
                                        @foreach ($sub_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-inline-error name="category" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Bill Type</label>
                                <div class="col-sm-10">
                                    <select class="form-select" wire:model.defer="bill_type">
                                        <option value="">--Select--</option>
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                    <x-inline-error name="bill_type" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Fee</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" wire:model.defer="fee" class="form-control">
                                    <x-inline-error name="fee" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="image" id="">
                                    <x-inline-error name="image" />
                                    <small wire:loading.class="d-block" style="display: none; font-size: 10px;" wire:target="image">
                                        <div class="spinner-border spinner-border-sm"></div> Processing image for upload ...
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <x-button name="Add New Course" target="add" />
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
        .create( document.querySelector( '#summary' ) )
        .then( editor => {
            editor.model.document.on('change:data', ()=>{
                @this.set('summary', editor.getData());
            });

            editor.editing.view.change( writer => {
                writer.setStyle( 'height', '300px', editor.editing.view.document.getRoot() );
            });
        } )
        .catch( error => {
            console.error( error );
        } );
    });
</script>
@endpush
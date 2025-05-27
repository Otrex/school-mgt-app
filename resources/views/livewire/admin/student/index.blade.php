<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Student</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Student Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $all_student_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <!-- Total Male Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                            <h5 class="card-title">Male</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-gender-male"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $male_student_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Female Student -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Female</h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-gender-female"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $female_student_count }}</h6>
                            </div>
                            </div>
                        </div>

                        </div>
                    </div><!-- End Total Female Card -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Students</h5>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.student.add') }}"><span class="bi bi-plus"></span></a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$students" />
                                    </div>
                                    <div>
                                        <form>
                                            <input type="search" wire:model="search" class="form-control form-control-sm" placeholder="Search ...">
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Reg No.</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($students as $student)
                                        <tr wire:key="{{ $student->id }}">
                                            <td>
                                                @if (!empty($student->image))
                                                <img src="{{ is_url($student->image) ? $student->image : asset("storage/avatar/".$student->image) }}" width="36" alt="Profile" class="rounded-circle">
                                                @else
                                                <div class="user-word-avatar-nav">
                                                    {{ $student->initial }}
                                                </div>
                                                @endif
                                            </td>
                                            <td><x-table-data :name="$student->reg_no" /></td>
                                            <td><x-table-data :name="$student->fullname" /></td>
                                            <td><x-table-data :name="ucwords($student->gender)" /></td>
                                            <td><x-table-data :name="$student->school" /></td>
                                            <td>
                                                <div class="d-flex text-center">
                                                    <a href="{{ route('admin.student.view', $student) }}" style="margin-right: 10px;"><span class="bi bi-eye-fill"></span></a>
                                                    <span x-data="{ modal: false }">
                                                        <a href="javascript:void(0)" @click="modal = true" x-id="['delete-{{ $student->id }}']">
                                                            <span class="bi bi-trash-fill text-danger"></span>
                                                        </a>
                                                        <div :id="$id('delete-{{ $student->id }}')">
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
                                                                                    <button type="button" class="btn btn-primary" wire:click="delete({{ $student->id }})">
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
                                            <td colspan="5"><div class="text-center"><em>Student(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $students->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
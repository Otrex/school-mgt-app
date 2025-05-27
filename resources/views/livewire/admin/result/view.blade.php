<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ $course->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.results') }}">All Result</a></li>
                <li class="breadcrumb-item active">{{ $course->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Total Course Card -->
                    <div class="col-xxl-12 col-md-12">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Result</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $results_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Student Card -->

                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Result table</h5>
                                    <a href="{{ route('admin.result.edit', $course) }}" class="btn btn-success btn-sm text-light">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <x-entries-count :collection="$results" />
                                    </div>
                                    <div>
                                        @if ($results->count() > 0)
                                        <form>
                                            <div class="d-flex align-items-center">
                                                <div><label for="filter">Session:</label></div>
                                                <select wire:model="session" id="filter" class="form-select">
                                                    @foreach ($sessions as $session)
                                                    <option value="{{ $session->session }}">{{ $session->session }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                        @else
                                            @if (($session != $current_session) && $results_count != 0)
                                            <a href="javascript:void(0);" wire:click="clear()">Back</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Reg No.</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">Score</th>
                                            <th scope="col">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($results as $result)
                                        <tr>
                                            <td><x-table-data :name="$result->user->fullname" /></td>
                                            <td><x-table-data :name="$result->user->reg_no" /></td>
                                            <td><x-table-data :name="$result->user->school" /></td>
                                            <td><x-table-data :name="$result->session" /></td>
                                            <td><x-table-data :name="$result->score" /></td>
                                            <td><x-table-data :name="$result->grade" /></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6"><div class="text-center"><em>Result(s) not available</em></div></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $results->links('vendor.livewire.bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->
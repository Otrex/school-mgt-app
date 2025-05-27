<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between w-100">
        <div>
            <h1 class="text-on-medium">Welcome to {{ $location }} Community</h1>
            <nav class="my-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('courses') }}" class="btn btn-primary">
                Take a program
            </a>
        </div>
    </div><!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-4">
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card sales-card h-100">

                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">Cummulative Percentage</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-percent"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($cummulative_percentage, 2) }}%</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->
                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card customers-card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">Badge</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$badge}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->
                     <!-- Revenue Card -->
                     <div class="col-xxl-3 col-md-3">
                        <div class="card info-card revenue-card h-100">

                            <div class="card-body  d-flex flex-column justify-content-between">
                                <h5 class="card-title">Percentile</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-diagram-2"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>--</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Referrer Card -->
                    <div class="col-xxl-3 col-md-3" id="ref-code" data-url="{{$referrer_route}}?code={{$referrer_code}}">
                        <div class="card info-card revenue-card h-100">

                            <div class="card-body  d-flex flex-column justify-content-between">
                                <h5 class="card-title">Referral Code</span></h5>

                                <div class="d-flex justify-content-center flex-column">
                                   <!-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-diagram-2"></i>
                                    </div> -->
                                    <div>
                                        <h6>{{$referrer_code}}</h6>
                                    </div>
                                    <div>
                                        <span style="font-size: 12px;">Click to copy</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <script>
                        function copyToClipboard() {
                            var content = document.getElementById('ref-code').getAttribute('data-url');
                            var tempInput = document.createElement('textarea');
                            tempInput.value = content;

                            document.body.appendChild(tempInput);
                            tempInput.select();
                            tempInput.setSelectionRange(0, 99999);
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);

                            iziToast.success({
                                title: 'Success!',
                                message: "copied!",
                                position: 'topRight'
                            });
                        }

                        document.getElementById('ref-code')
                            .addEventListener('click', copyToClipboard);
                    </script>

                </div>
            </div>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Programs</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                Showing {{ $attempted_programs->count() }} of total programs.
                            </div>

                            <div>
                                <a href="javascript:void(0);" title="Print Result" class="print-result"><span class="bi bi-printer-fill"></span></a>
                            </div>
                        </div>
                        <table class="table table-stripped">
                            <thead>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th scope="col">Program</th>
                                    <th scope="col">Number of lesson</th>
                                    <th scope="col">Completion Status</th>
                                    <th scope="col">Date Started</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attempted_programs as $program)
                                <tr>
                                    <td>{{ $program->course->name }}</td>
                                    <td>{{ $this->getProgramLessonCount($program->course->id) }}</td>
                                    <td>
                                        @if ($this->isLessonCompleted($program->course->id))
                                        <span class="tag completed">
                                            Completed
                                        </span>
                                        @else
                                        <span class="tag pending">
                                            In progress
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $program->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($this->isLessonCompleted($program->course->id))
                                        <a href="javascript:void(0)" title="View Result Details" class="text-center">
                                            <span class="bi bi-check-circle-fill text-success"></span>
                                        </a>
                                        @else
                                        <a href="{{ route('course.detail', $program->course) }}" title="View Result Details" class="text-center">
                                            <small style="vertical-align: middle;">Continue</small><span style="vertical-align: middle;" class="bi bi-arrow-right"></span>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><div class="text-center"><em>Result(s) not available</em></div></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
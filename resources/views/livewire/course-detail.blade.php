

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>{{ $course->name }}</h2>
            <p>
                <a href="{{ route('courses') }}" class="text-light">All Programs</a> <i class="bi bi-caret-right-fill"></i>
                <span class="text-light">{{ $course->name }}</span>
            </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details" style="padding-bottom: 30px;">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="{{ $course->image }}" class="img-fluid" alt="">
                    <h3>{{ $course->name }}</h3>
                    <p>
                        {!! $course->summary !!}
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Category</h5>
                        <p>{{ ucwords($course->courseCategory->name) }}</p>
                    </div>
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Program Type</h5>
                        <p>{{ $course->bill_type." Course" }}</p>
                    </div>
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Program Fee</h5>
                        <p>&#8358;{{ number_format($course->fee, 2) }}</p>
                    </div>
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Publish Date</h5>
                        <p>{{ $course->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Language </h5>
                        <div class="col-md-6 col-lg-6">
                            <select class="form-select" wire:model="language" id="mySelect" onchange="selectLanguages()">
                                @foreach ($languages as $lang)
                                    <option value="{{ $lang->id }}" selected="{{ null !== session('selected_language') && session('selected_language')->id == $lang->id }}">{{ $lang->language }}</option>
                                @endforeach
                            </select>
                            <x-inline-error name="language" />
                        </div>
                    </div>
                    <div>
                        @if (auth()->check() || auth('community')->check())
                            @if($course->bill_type == "Paid" && !is_null($payments_made) && ($payments_made->count() == 0))
                            <div class="p-2 my-2">
                                <div class="row not-login-notice">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="text-center login-notice">
                                            <div><span class="bi bi-person-circle" style="font-size: 1.6rem;"></span></div>
                                            <div class="text-dark bold">Looks like you have not purchase this program.</div>
                                            <div class="text-secondary">Purchase this program in order to have access to it.</div>
                                            <div><a href="{{ route('purchase.course', $course) }}" class="login-btn">Purchase course</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                        <div class="p-2 my-2">
                            <div class="row not-login-notice">
                                <div class="col-lg-12 col-xxl-12 col-sm-12">
                                    <div class="text-center login-notice">
                                        <div><span class="bi bi-person-circle" style="font-size: 1.6rem;"></span></div>
                                        <div class="text-dark bold">Looks like you are not logged in</div>
                                        <div class="text-secondary">Be sure to log in order to keep track of your progress</div>
                                        <div><a href="{{ route('student.login', ['next' => "/program/{$course->slug}"]) }}" class="login-btn">Log In</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Cource Details Section -->

    @if ($course_series->count() > 0)
    <section id="cource-details-tabs" class="cource-details-tabs">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12 mb-4">
                    <div class="series-info">
                        <span><i class="bi bi-stack"></i> {{ $course_series->count() }} Lessons</span>&nbsp;|&nbsp;
                        <span><i class="bi bi-clock-fill"></i> {{ $course->duration }}</span>
                    </div>
                </div>
            </div>

            @foreach ($course_series as $series)
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                    {{--
                        if the series serial no. is equal to the next series and the series is not completed,
                        enable the link with the serial no. visible
                    --}}
                    @if ($series->serial_no == $next && !is_completed(course_id: $course->id, series_id: $series->id))
                    <div class="series-card">
                        <div class="series-serial">
                            <span>{{ $series->serial_no }}</span>
                        </div>
                        <div class="series-content-wrapper">
                            <div class="series-title">
                                <span><a href="{{ route('course.detail.lesson', [$course, $series->serial_no]) }}">{{ ucwords($series->title) }}  </a></span>
                            </div>
                            <div class="series-summary">
                                {{ $series->summary }}

                            </div>
                        </div>
                    </div>
                    @endif

                    {{--
                        if the series is completed; mark complete
                        with the link enabled
                    --}}
                    @if(is_completed(course_id: $course->id, series_id: $series->id))
                    <div class="series-card">
                        <div class="series-serial series-completed">
                            <span class="bi bi-check"></span>
                        </div>
                        <div class="series-content-wrapper">
                            <div class="series-title">
                                <span><a href="{{ route('course.detail.lesson', [$course, $series->serial_no]) }}">{{ ucwords($series->title) }}</a></span>
                            </div>
                            <div class="series-summary">
                                {{ $series->summary }}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Lock all series except series with $next series --}}
                    @if ($series->serial_no !== $next && !is_completed(course_id: $course->id, series_id: $series->id))
                    <div class="series-card">
                        <div class="series-serial">
                            <span class="bi bi-lock"></span>
                        </div>
                        <div class="series-content-wrapper">
                            <div class="series-title">
                                <span><a>{{ ucwords($series->title) }}</a></span>
                            </div>
                            <div class="series-summary">
                                {{ $series->summary }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @else
    <p><center><em>No series available for this program</em></center></p>
    @endif
</main><!-- End #main -->
<script>
function selectLanguages() {
  var x = document.getElementById("mySelect").value;
  window.location.replace(window.location.href.split('?')[0] + "?language=" + x);
}

@if(session()->has('success'))
    window.onload = function() {
        window.dispatchEvent(new CustomEvent('success', {
            detail: '{{ session("success") }}'
        }));
    }
@endif
</script>

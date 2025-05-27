<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>{{ $series->serial_no }}. {{ ucwords($series->title) }}</h2>
            <p>
                <a href="{{ route('courses') }}" class="text-light">All Programs</a>
                <i class="bi bi-caret-right-fill"></i>
                <a href="{{ route('course.detail', $course) }}" class="text-light">{{ $course->name }}</a>
                <i class="bi bi-caret-right-fill"></i>
                <span class="text-light">{{ $series->serial_no }}. {{ ucwords($series->title) }}</span>
            </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details" style="padding-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xxl-8 m-auto">
                    @foreach ($course_content as $series_content)
                        @if (auth()->check() || auth('community')->check())
                            <div class="d-flex justify-content-center">
                                <!-- <img src="{{ $course->image }}" class="img-fluid" alt=""> -->
                                @if(!empty($series_content->video_content) )
                                    <div>
                                        <iframe width="560" height="315" src="{{ $series_content->video_content}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="width: 700px;height: 500px;"></iframe>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach

                    @if (auth()->check() || auth('community')->check())
                        {{-- For free course --}}
                        @if ($course->bill_type == "Free")
                        <h3>{{ $series->title }}</h3>
                        <p>
                            {!! $series->summary !!}
                        </p>
                        @forelse ($course_content as $series_content)
                        <p>
                            {!! $series_content->text_content !!}
                        </p>
                        @empty
                        <p>
                            <center><em>No Lesson Content available for this program</em></center>
                        </p>
                        @endforelse
                        <p class="d-flex justify-content-between align-items-center">
                            @if (($series->serial_no - 1) == 0)
                            <a class="secondary-link">
                                <i class="bi bi-caret-left-fill"></i>
                                <span>Previous Lesson</span>
                            </a>
                            @else
                            <a class="info-link" href="{{ route('course.detail.lesson', [$course, $series->serial_no - 1]) }}">
                                <i class="bi bi-caret-left-fill"></i>
                                <span>Previous Lesson</span>
                            </a>
                            @endif

                            {{-- if serial_no plus the next Lesson count is greater than total series: die the link --}}
                            @if (($series->serial_no + 1) > $total_series)
                            <a class="secondary-link">
                                <span>End of Lesson</span>
                                <i class="bi bi-caret-right-fill"></i>
                            </a>
                            @else
                                {{-- if the series is completed; enable the link else disable it --}}
                                @if ($is_completed($series->id))
                                <a class="info-link" href="{{ route('course.detail.lesson', [$course, $series->serial_no + 1]) }}">
                                    <span>Next Lesson</span>
                                    <i class="bi bi-caret-right-fill"></i>
                                </a>
                                @else
                                <a class="secondary-link">
                                    <span>Next Lesson</span>
                                    <i class="bi bi-caret-right-fill"></i>
                                </a>
                                @endif
                            @endif
                        </p>
                        <p class="d-flex justify-content-center align-items-center">
                            {{-- If course is completed --}}
                            @if ($is_completed($series->id))
                            <button type="button" class="btn-completed mr-1">
                                <span>Completed</span>
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            @if (($series->serial_no + 1) > $total_series && $is_exam_available && !$is_exam_taken)
                            <button type="button" wire:click="takeTest" class="btn-mark-completed">
                                <span>Take Test</span>
                                <i wire:loading.remove class="bi bi-arrow-right-circle-fill" wire:target="takeTest"></i>
                                <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="takeTest"></i>
                            </button>
                            @endif
                            @else
                            <button wire:click="markCompleted({{ $series->id }}, {{ $series->serial_no }})" type="button" class="btn-mark-completed">
                                <span>Mark completed</span>
                                <i wire:loading.remove class="bi bi-check-circle-fill"></i>
                                <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="markCompleted"></i>
                            </button>
                            @endif
                        </p>

                        {{-- For paid course --}}
                        @elseif($course->bill_type == "Paid" && !is_null($payments_made) && $payments_made->count() > 0)
                        <h3>{{ $series->title }}</h3>
                        <p>
                            {!! $series->summary !!}
                        </p>
                        @forelse ($course_content as $series_content)
                        <p>
                            {!! $series_content->text_content !!}
                        </p>
                        @empty
                        <p>
                            <center><em>No Lesson Content available for this program</em></center>
                        </p>
                        @endforelse
                        <p class="d-flex justify-content-between align-items-center">
                            @if (($series->serial_no - 1) == 0)
                            <a class="secondary-link">
                                <i class="bi bi-caret-left-fill"></i>
                                <span>Previous Lesson</span>
                            </a>
                            @else
                            <a class="info-link" href="{{ route('course.detail.lesson', [$course, $series->serial_no - 1]) }}">
                                <i class="bi bi-caret-left-fill"></i>
                                <span>Previous Lesson</span>
                            </a>
                            @endif

                            {{-- if serial_no plus the next Lesson count is greater than total series: die the link --}}
                            @if (($series->serial_no + 1) > $total_series)
                            <a class="secondary-link">
                                <span>End of Lesson</span>
                                <i class="bi bi-caret-right-fill"></i>
                            </a>
                            @else
                                {{-- if the series is completed; enable the link else disable it --}}
                                @if ($is_completed($series->id))
                                <a class="info-link" href="{{ route('course.detail.lesson', [$course, $series->serial_no + 1]) }}">
                                    <span>Next Lesson</span>
                                    <i class="bi bi-caret-right-fill"></i>
                                </a>
                                @else
                                <a class="secondary-link">
                                    <span>Next Lesson</span>
                                    <i class="bi bi-caret-right-fill"></i>
                                </a>
                                @endif
                            @endif
                        </p>
                        <p class="d-flex justify-content-center">
                            @if ($is_completed($series->id))
                            <button type="button" class="btn-completed mr-1">
                                <span>Completed</span>
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            @if (($series->serial_no + 1) > $total_series && $is_exam_available && !$is_exam_taken)
                            <button type="button" wire:click="takeTest" class="btn-mark-completed">
                                <span>Take Test</span>
                                <i wire:loading.remove class="bi bi-arrow-right-circle-fill" wire:target="takeTest"></i>
                                <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="takeTest"></i>
                            </button>
                            @endif
                            @else
                            <button wire:click="markCompleted({{ $series->id }}, {{ $series->serial_no }})" type="button" class="btn-mark-completed">
                                <span>Mark completed</span>
                                <i wire:loading.remove class="bi bi-check-circle-fill" wire:target="markCompleted"></i>
                                <i wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="markCompleted"></i>
                            </button>
                            @endif
                        </p>
                        @else
                        <div class="p-2 my-2">
                            <div class="row not-login-notice">
                                <div class="col-lg-6 col-sm-12 my-3">
                                    <div class="mb-5 bold series-title">{{ $series->title }}</div>
                                    <div class="d-flex justify-content-between info-series">
                                        <div>
                                            <div class="bold">Lesson</div>
                                            <div>{{ $series->serial_no }}</div>
                                        </div>
                                        <div>
                                            <div class="bold">Category</div>
                                            <div>{{ $course->courseCategory->name }}</div>
                                        </div>
                                        <div>
                                            <div class="bold">Language</div>
                                            <div>{{ session('selected_language')->language }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
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
                            <div class="col-lg-6 col-xxl-6 col-sm-12 my-3">
                                <div class="mb-5 bold series-title" style="font-weight: bold;">{{ $series->title }}</div>
                                <div class="d-flex justify-content-between info-series">
                                    <div>
                                        <div class="bold">Lesson</div>
                                        <div>{{ $series->serial_no }}</div>
                                    </div>
                                    <div>
                                        <div class="bold">Category</div>
                                        <div>{{ $course->courseCategory->name }}</div>
                                    </div>
                                    <div>
                                        <div class="bold">Language</div>
                                        <div>{{ session('selected_language')->language }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-6 col-sm-12">
                                <div class="text-center login-notice">
                                    <div><span class="bi bi-person-circle" style="font-size: 1.6rem;"></span></div>
                                    <div class="text-dark bold">Looks like you are not logged in</div>
                                    <div class="text-secondary">Be sure to log in order to keep track of your progress</div>
                                    <div><a href="{{ route('student.login', ['next' => "/program/{$course->slug}/lesson/{$series->serial_no}"]) }}" class="login-btn">Log In</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

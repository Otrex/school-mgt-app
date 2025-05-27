<main id="main" class="main">
    <div class="pagetitle">
        <h1>Result View</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('community.member.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('community.member.results') }}">Results</a></li>
                <li class="breadcrumb-item active">Result View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="text-center bold"><h4 style="text-decoration: underline;">{{ $exam_result->exam->course->name }}</h4></div>
                        <div class="d-flex justify-content-between flex-column  align-items-center">
                            <div>
                                <span>Here are the corrections to the accessment test</span>
                            </div>
                            <div>
                                <span class="bold">Total Score:</span>
                                <span>{{ $exam_result->score."/".$exam_result->exam->number_of_question }}</span>
                            </div>
                        </div>
                        @foreach ($answers as $answer)
                        <div class="mt-5" wire:key="{{ $answer->id }}">
                            <div class="bold mb-2">Question {{ $page }}</div>
                            <div class="mb-2">{!! $answer->question->question !!}</div>
                            @foreach ($answer->question->option_questions as $option)
                            <div class="mb-1">
                                <span class="bold mr-1">({{ $option_tag[$loop->index] }})</span>
                                <label for="option1" class="option-list
                                    {{ ($answer->option_question_id == $option->id && $option->is_correct) ? 'correct' : '' }}
                                    {{ ($option->is_correct) ? 'correct' : '' }}
                                    {{ ($answer->option_question_id == $option->id && !$option->is_correct) ? 'incorrect' : '' }}
                                    ">
                                    {{ $option->value }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    <div class="margin-top-90px">
                        {{ $answers->links('vendor.livewire.bootstrap') }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
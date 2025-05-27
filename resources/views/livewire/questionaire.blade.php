<main id="main">
    <section id="course-details" class="course-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-9 m-auto">
                    <div class="text-center bold"><h3>{{ $exam->course->name }}</h3></div>
                    <div class="d-flex justify-content-between flex-column  align-items-center">
                        <div>
                            <span class="bold">Instruction:</span>
                            <span>{{ $exam->instruction }}</span>
                        </div>
                        <div>
                            <span class="bold">Total Question:</span>
                            <span>{{ $exam->number_of_question }}</span>
                        </div>
                        <div wire:ignore>
                            <span class="bold">Time Remaining:</span>
                            <span id="display-time"></span>
                        </div>
                    </div>
                    @foreach ($questions as $question)
                        @if ($this->isAnswerAvailable($question->id))
                        <div class="mt-5" wire:key="{{ $question->id }}">
                            <div class="bold mb-2">Question {{ $page }} <i wire:loading.class="spinner-border spinner-border-sm text-dark" wire:target="updateAnswer"></i></div>
                            <div class="mb-2">{!! $question->question !!}</div>
                            @foreach ($question->option_questions->shuffle() as $option)
                            <div class="mb-1">
                                <span class="bold mr-1">
                                    ({{ $option_tag[$loop->index] }})
                                </span>
                                <label for="option1" class="option-list {{ $this->isSelected($question->id, $option->id) ? 'active' : '' }}">{{ $option->value }}</label>
                                <input type="radio" wire:key="{{ $option->value }}" wire:click="updateAnswer({{ $question->id }}, {{ $option->id }}, '{{ $option->value }}')" wire:model="answer" class="visually-hidden" name="option" id="option1" value="1">
                            </div>
                            @endforeach

                        </div>
                        @else
                        <div class="mt-5">
                            <div class="bold mb-2">Question {{ $page }} <i wire:loading.class="spinner-border spinner-border-sm text-dark" wire:target="saveAnswer"></i></div>
                            <div class="mb-2">{!! $question->question !!}</div>

                            @foreach ($question->option_questions->shuffle() as $option)
                            <div class="mb-1">
                                <span class="bold mr-1">
                                    ({{ $option_tag[$loop->index] }})
                                </span>
                                <label for="{{ $option->value }}" class="option-list" {{ $this->isSelected($question->id, $option->id) ? 'active' : '' }}>{{ $option->value }}</label>
                                <input type="radio" wire:click="saveAnswer({{  $question->id }}, {{  $option->id }}, '{{  $option->value }}')" wire:model="answer" class="visually-hidden" id="{{  $option->value }}" value="{{  $option->value }}">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    @endforeach
                    <div class="d-flex justify-content-end align-items-center mt-4">
                        @if ($questions_count == $page)
                        <span x-data="{ modal: false }">
                            <button type="button" @click="modal = true" x-id="['submit']" class="btn btn-submit btn-small">Submit</button>
                            <div :id="$id('submit')">
                                <div class="modal-wrapper" x-show="modal" x-cloak>
                                    <div class="modal-bg-wrapper">
                                        <div class="modal-bg"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button @click="modal = false" class="close-btn">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <div class="modal-icon">
                                                        <div class="bi bi-info-circle-fill"></div>
                                                    </div>
                                                    <div class="bold mt-2">You are about to submit all your answers.</div>
                                                    <div class="fs-12px">Are you sure?</div>
                                                    <div class="mt-3">
                                                        <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                        <button type="button" class="btn btn-primary" wire:click="submitAnswers">
                                                            Confirm
                                                            <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="submitAnswers"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                        @else
                        <button type="button" wire:click="nextPage" class="btn btn-submit btn-small">Next <i class="bi bi-arrow-right-circle-fill"></i></button>
                        @endif
                    </div>
                    <div class="margin-top-90px">
                        {{ $questions->links('vendor.livewire.bootstrap') }}
                    </div>
                    <h3></h3>
                    @if ($questions_count !== $page)
                    <span x-data="{ modal: false }">
                        <button type="button" @click="modal = true" x-id="['submit']" class="btn btn-submit btn-small">Submit</button>
                        <div :id="$id('submit')">
                            <div class="modal-wrapper" x-show="modal" x-cloak>
                                <div class="modal-bg-wrapper">
                                    <div class="modal-bg"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <button @click="modal = false" class="close-btn">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </div>
                                            <div class="text-center">
                                                <div class="modal-icon">
                                                    <div class="bi bi-info-circle-fill"></div>
                                                </div>
                                                <div class="bold mt-2">You are about to submit all your answers.</div>
                                                <div class="fs-12px">Are you sure?</div>
                                                <div class="mt-3">
                                                    <button type="button" class="btn btn-secondary" @click="modal = false">Cancel</button>
                                                    <button type="button" class="btn btn-primary" wire:click="submitAnswers">
                                                        Confirm
                                                        <span wire:loading.class="spinner-border spinner-border-sm text-light" wire:target="submitAnswers"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
    <script>
        const COUNTER_KEY = {{ $time_duration }};

        function countDown (i, callback) {
            timer = setInterval (function () {
                minutes = parseInt (i / 60, 10);
                seconds = parseInt (i % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                document.getElementById ("display-time").innerHTML = "0hr:" + minutes + "min:" + seconds + "sec";
                if ( (i--) > 0) {
                    window.sessionStorage.setItem (COUNTER_KEY, i);
                } else {
                    window.sessionStorage.removeItem (COUNTER_KEY);
                    clearInterval(timer);
                    callback();
                }
            }, 1000);
        }

        window.onload = function () {
            var countDownTime = window.sessionStorage.getItem (COUNTER_KEY) || {{ $time_duration }};
            countDown (countDownTime, function () {
                Livewire.emit('submitAnswers');
            });
        };

    </script>
@endpush
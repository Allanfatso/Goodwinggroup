@foreach ($exercise_plan as $exercise_plans)
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8 items-start">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    {{ e($exercise_plans->exercise_plans->fitness_level) }}
                </h2>
                @php
                    $allowedKeys = [
                        'Target Weight' => $exercise_plans->exercise_plans->target_weight,
                        'Weekly Workout Plan Duration' => $exercise_plans->exercise_plans->plan_duration_weeks,
                    ];
                @endphp

                @foreach ($allowedKeys as $key => $value)
                    @if (!empty($value))
                        <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300 mt-3">
                            <strong>{{ $key }}:</strong> {{ e($value) }}
                        </p>
                    @endif
                @endforeach


                <div class="mt-6">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Plans</h3>

                    <div id="reviews-container-{{ $exercise_plans->id }}">
                        @if ($exercise_plans->exercise_plans->isNotEmpty())
                            <!-- Show only the first review -->
                            @include('partials.plan_card')
                        @endif
                    </div>

                    @if ($exercise_plans->exercise_plans->count() > 1)
                        <button class="see-more-btn bg-orange-700 text-white px-4 py-2 rounded-lg mt-4" data-movie-id="{{ $exercise_plans->id }}">
                            See More
                        </button>
                    @endif

                    @if ($movie->reviews->isEmpty())
                        <p>No reviews yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seeMoreButtons = document.querySelectorAll('.see-more-btn');

    seeMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const movieId = this.getAttribute('data-movie-id');
            const container = document.getElementById('reviews-container-' + movieId);

            fetch('/reviews/ajax/' + movieId)
                .then(response => response.json())
                .then(data => {
                    container.innerHTML += data.html;
                    this.remove(); // Removes the See More button after loading
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endpush

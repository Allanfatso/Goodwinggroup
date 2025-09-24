<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-primary">
            {{ $plan['seo_title'] ?? 'Workout Plan' }}
        </h2>
    </x-slot>

    <div class="p-6 bg-base-200 rounded-xl shadow-lg space-y-6">
        <div class="space-y-2">
            <p><strong>Goal:</strong> {{ $plan['goal'] ?? '-' }}</p>
            <p><strong>Fitness Level:</strong> {{ $plan['fitness_level'] ?? '-' }}</p>
            <p><strong>Total Weeks:</strong> {{ $plan['total_weeks'] ?? '-' }}</p>
            <p><strong>Days per Week:</strong> {{ $plan['schedule']['days_per_week'] ?? '-' }}</p>
            <p><strong>Session Duration:</strong> {{ $plan['schedule']['session_duration'] ?? '-' }} mins</p>
        </div>

        <div class="space-y-8">
            <h2 class="text-10xl font-bold text-primary"><strong>Exercises</strong></h2>
            <br>

            @foreach($plan['exercises'] ?? [] as $day)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow">
                    <h4 class="text-xl font-bold mb-3">{{ $day['day'] }}</h4>
                    <ul class="space-y-2">
                        @foreach($day['exercises'] as $exercise)
                            <li class="border-b pb-2">
                                <p class="font-semibold">{{ $exercise['name'] }}</p>
                                <p class="text-sm">Sets: {{ $exercise['sets'] ?? '-' }} | Reps: {{ $exercise['repetitions'] ?? '-' }} | Duration: {{ $exercise['duration'] ?? '-' }}</p>
                                <p class="text-xs text-gray-500">Equipment: {{ $exercise['equipment'] ?? 'None' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>

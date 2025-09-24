<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-center text-pink-500">
            {{ $plan['seo_title'] ?? 'Workout Plan' }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-8 mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 space-y-10">

        <!-- Plan Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-gray-700">
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Goal</p>
                <p class="text-lg font-semibold">{{ $plan['goal'] ?? '-' }}</p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Fitness Level</p>
                <p class="text-lg font-semibold">{{ $plan['fitness_level'] ?? '-' }}</p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Total Weeks</p>
                <p class="text-lg font-semibold">{{ $plan['total_weeks'] ?? '-' }}</p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Days / Week</p>
                <p class="text-lg font-semibold">{{ $plan['schedule']['days_per_week'] ?? '-' }}</p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Session Duration</p>
                <p class="text-lg font-semibold">{{ $plan['schedule']['session_duration'] ?? '-' }} mins</p>
            </div>
        </div>

        <!-- Exercises Section -->
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6H9zM3 13h6v8H3z" />
                </svg>
                Exercises
            </h3>

            <div class="space-y-8">
                @foreach($plan['exercises'] ?? [] as $day)
                    <div class="bg-gray-50 rounded-xl shadow p-6 hover:shadow-md transition-all duration-200">
                        <h4 class="text-xl font-semibold text-pink-600 mb-4">
                            {{ $day['day'] }}
                        </h4>
                        <ul class="divide-y divide-gray-200">
                            @foreach($day['exercises'] as $exercise)
                                <li class="py-3">
                                    <p class="font-semibold text-gray-800">{{ $exercise['name'] }}</p>
                                    <p class="text-sm text-gray-600">
                                        Sets: <span class="font-medium">{{ $exercise['sets'] ?? '-' }}</span> |
                                        Reps: <span class="font-medium">{{ $exercise['repetitions'] ?? '-' }}</span> |
                                        Duration: <span class="font-medium">{{ $exercise['duration'] ?? '-' }}</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Equipment: {{ $exercise['equipment'] ?? 'None' }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

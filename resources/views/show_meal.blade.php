<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-center text-pink-500">
            {{ $plan['seo_title'] ?? $savedMeal->seo_title ?? 'Meal Plan' }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-8 mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 space-y-10">

        <!-- Plan Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-gray-700">
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Plan Name</p>
                <p class="text-lg font-semibold">
                    {{ $plan['exercise_name'] ?? $savedMeal->exercise_name ?? '-' }}
                </p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Goal</p>
                <p class="text-lg font-semibold">
                    {{ $plan['goal'] ?? $savedMeal->goal ?? '-' }}
                </p>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl shadow-sm">
                <p class="text-sm font-medium text-pink-600">Calories / Day</p>
                <p class="text-lg font-semibold">
                    {{ $plan['calories_per_day'] ?? $savedMeal->calories_per_day ?? '-' }}
                </p>
            </div>
        </div>

        <!-- Description -->
        @if(!empty($plan['description']) || !empty($savedMeal->description))
            <div class="bg-gray-50 p-6 rounded-xl shadow">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Description</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $plan['description'] ?? $savedMeal->description }}
                </p>
            </div>
        @endif

        <!-- Macronutrients -->
        @php
            $macros = $plan['macronutrients'] ?? ($savedMeal->macronutrients ?? null);
        @endphp

        @if(!empty($macros) && is_array($macros))
            <div class="bg-gray-50 p-6 rounded-xl shadow">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Macronutrients</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($macros as $k => $v)
                        <div class="p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                            <p class="text-sm font-medium text-pink-600 capitalize">
                                {{ str_replace('_', ' ', $k) }}
                            </p>
                            <p class="text-lg font-semibold text-gray-800">{{ $v }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Meal Suggestions -->
        @php
            $suggestions = $plan['meal_suggestions'] ?? ($savedMeal->meal_suggestions ?? null);
        @endphp

        @if(!empty($suggestions) && is_array($suggestions))
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    Meal Suggestions
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($suggestions as $mealBlock)
                        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition-all duration-200">
                            <h4 class="text-lg font-semibold text-pink-600 mb-3">
                                {{ $mealBlock['meal'] ?? ($mealBlock['title'] ?? 'Meal') }}
                            </h4>

                            @if(!empty($mealBlock['suggestions']) && is_array($mealBlock['suggestions']))
                                <ul class="space-y-3">
                                    @foreach($mealBlock['suggestions'] as $suggest)
                                        <li class="border-b pb-3">
                                            <p class="font-semibold text-gray-800">
                                                {{ $suggest['name'] ?? ($suggest['title'] ?? 'Suggestion') }}
                                            </p>

                                            @if(!empty($suggest['ingredients']) && is_array($suggest['ingredients']))
                                                <p class="text-sm text-gray-600">
                                                    Ingredients: {{ implode(', ', $suggest['ingredients']) }}
                                                </p>
                                            @endif

                                            @if(isset($suggest['calories']))
                                                <p class="text-sm text-gray-600">
                                                    Calories: <span class="font-medium">{{ $suggest['calories'] }}</span>
                                                </p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">
                                    {{ is_string($mealBlock['suggestions'] ?? null) ? $mealBlock['suggestions'] : 'No suggestions available.' }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Footer -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('dashboard.index') }}" class="btn btn-ghost">← Back to Dashboard</a>

            @if(isset($savedMeal) && $savedMeal->exists)
                <span class="text-sm text-green-600 font-medium">✅ Saved to your meals</span>
            @else
                <span class="text-sm text-gray-500">Not saved</span>
            @endif
        </div>
    </div>
</x-app-layout>

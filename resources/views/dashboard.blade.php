<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold text-primary">{{ __('Dashboard') }}</h2>
  </x-slot>

  <!-- Displaying the exercise plans and nutrition plans from the controller -->
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-2xl font-semibold mb-4">Your Exercise Plans</h3>
        @include('partials.show_plans', ['exercise_plan' => $exercise_plan])

  </div>
</x-app-layout>


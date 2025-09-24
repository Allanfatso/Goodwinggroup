<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold text-primary">Dashboard</h2>
  </x-slot>
  <div class="p-6 bg-white border-b border-gray-200">
    <h3 class="text-2xl font-semibold mb-4">Your Workouts</h3>
    @if($workouts->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($workouts as $workout)
          <div class="p-4 bg-base-200 rounded-lg shadow">
            <h4 class="text-xl font-bold mb-2">{{ $workout->name }}</h4>
            <p><strong>Day:</strong> {{ $workout->day }}</p>
            <p><strong>Duration:</strong> {{ $workout->duration ?? 'N/A' }}</p>
            <p><strong>Sets:</strong> {{ $workout->sets ?? 'N/A' }}</p>
            <p><strong>Reps:</strong> {{ $workout->repetitions ?? 'N/A' }}</p>
            <p><strong>Equipment:</strong> {{ $workout->equipment ?? 'None' }}</p>

            <div class="flex space-x-2 mt-3">
              <a href="{{ route('dashboard.edit', ['dashboard' => $workout->id, 'type' => 'workout']) }}"
                 class="btn btn-primary btn-sm">
                Edit
              </a>

              <form action="{{ route('dashboard.destroy', $workout->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="type" value="workout">
                <button type="submit" class="btn btn-error btn-sm">Delete</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p>You have no workouts yet.</p>
    @endif
  </div>

  <div class="p-6 bg-white border-b border-gray-200 mt-6">
    <h3 class="text-2xl font-semibold mb-4">Your Meals</h3>
    @if($meals->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($meals as $meal)
          <div class="p-4 bg-base-200 rounded-lg shadow">
            <h4 class="text-xl font-bold mb-2">{{ $meal->exercise_name }}</h4>
            <p><strong>Goal:</strong> {{ $meal->goal ?? 'N/A' }}</p>
            <p><strong>Calories/day:</strong> {{ $meal->calories_per_day ?? 'N/A' }}</p>
            <p><strong>Description:</strong> {{ $meal->description ?? 'N/A' }}</p>

            @if($meal->macronutrients)
              <p><strong>Macros:</strong> {{ json_encode($meal->macronutrients) }}</p>
            @endif

            <div class="flex space-x-2 mt-3">
              <a href="{{ route('dashboard.edit', ['dashboard' => $meal->id, 'type' => 'meal']) }}"
                 class="btn btn-primary btn-sm">
                Edit
              </a>

              <form action="{{ route('dashboard.destroy', $meal->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="type" value="meal">
                <button type="submit" class="btn btn-error btn-sm">Delete</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p>You have no meals yet.</p>
    @endif
  </div>
</x-app-layout>

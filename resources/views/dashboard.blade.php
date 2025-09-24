<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-extrabold text-center text-pink-500">Dashboard</h2>
  </x-slot>


  <div class="p-6 max-w-7xl mx-auto">
    <h3 class="text-2xl font-bold flex items-center mb-6 text-gray-800">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
      </svg>
      Your Workouts
    </h3>

    @if($workouts->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($workouts as $workout)
          <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-100">
            <h4 class="text-xl font-semibold text-pink-600 mb-3">{{ $workout->name }}</h4>

            <div class="space-y-1 text-gray-700 text-sm">
              <p><span class="font-semibold">Day:</span> {{ $workout->day }}</p>
              <p><span class="font-semibold">Duration:</span> {{ $workout->duration ?? 'N/A' }}</p>
              <p><span class="font-semibold">Sets:</span> {{ $workout->sets ?? 'N/A' }}</p>
              <p><span class="font-semibold">Reps:</span> {{ $workout->repetitions ?? 'N/A' }}</p>
              <p><span class="font-semibold">Equipment:</span> {{ $workout->equipment ?? 'None' }}</p>
            </div>


            <div class="flex space-x-3 mt-5">
              <a href="{{ route('dashboard.edit', ['dashboard' => $workout->id, 'type' => 'workout']) }}"
                 class="btn btn-sm rounded-full px-5 bg-pink-500 hover:bg-pink-600 text-white shadow-md transition-all duration-200">
                Edit
              </a>
              <form action="{{ route('dashboard.destroy', $workout->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="type" value="workout">
                <button type="submit"
                        class="btn btn-sm rounded-full px-5 bg-transparent border border-pink-500 text-pink-500 hover:bg-pink-500 hover:text-white shadow transition-all duration-200">
                  Delete
                </button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500 italic">You have no workouts yet.</p>
    @endif
  </div>


  <div class="p-6 max-w-7xl mx-auto mt-10">
    <h3 class="text-2xl font-bold flex items-center mb-6 text-gray-800">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      Your Meals
    </h3>

    @if($meals->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($meals as $meal)
          <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-100">
            <h4 class="text-xl font-semibold text-pink-600 mb-3">{{ $meal->exercise_name }}</h4>

            <div class="space-y-1 text-gray-700 text-sm">
              <p><span class="font-semibold">Goal:</span> {{ $meal->goal ?? 'N/A' }}</p>
              <p><span class="font-semibold">Calories/day:</span> {{ $meal->calories_per_day ?? 'N/A' }}</p>
              <p><span class="font-semibold">Description:</span> {{ $meal->description ?? 'N/A' }}</p>

              @if($meal->macronutrients)
                <p><span class="font-semibold">Macros:</span> {{ json_encode($meal->macronutrients) }}</p>
              @endif
            </div>


            <div class="flex space-x-3 mt-5">
              <form action="{{ route('dashboard.destroy', $meal->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="type" value="meal">
                <button type="submit"
                        class="btn btn-sm rounded-full px-5 bg-transparent border border-pink-500 text-pink-500 hover:bg-pink-500 hover:text-white shadow transition-all duration-200">
                  Delete
                </button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500 italic">You have no meals yet.</p>
    @endif
  </div>
</x-app-layout>

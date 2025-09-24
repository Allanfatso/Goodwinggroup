<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-extrabold text-center text-pink-500">Edit Workout</h2>
  </x-slot>

  <div class="max-w-lg mx-auto p-6 mt-6 bg-base-200 rounded-2xl shadow-lg">
    <form action="{{ route('dashboard.update', $workout->id) }}" method="POST" class="space-y-5">
      @csrf
      @method('PATCH')

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sets</label>
        <input type="text" name="sets"
               value="{{ old('sets', $workout->sets) }}"
               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Repetitions</label>
        <input type="text" name="repetitions"
               value="{{ old('repetitions', $workout->repetitions) }}"
               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
        <input type="text" name="duration"
               value="{{ old('duration', $workout->duration) }}"
               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none">
      </div>


      <div class="flex justify-between items-center pt-4">
        <button type="submit"
                class="btn bg-pink-500 hover:bg-pink-600 text-white rounded-full px-6 shadow-md transition-all duration-200">
          Save Changes
        </button>
        <a href="{{ route('dashboard.index') }}"
           class="btn bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full px-6 shadow-sm transition-all duration-200">
          Cancel
        </a>
      </div>
    </form>
  </div>
</x-app-layout>

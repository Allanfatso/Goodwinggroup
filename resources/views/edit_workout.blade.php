<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold text-primary">Edit Workout</h2>
  </x-slot>

  <div class="p-6 bg-white border-b border-gray-200 max-w-lg mx-auto">
    <form action="{{ route('dashboard.update', $workout->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PATCH')

      <div>
        <label class="block font-semibold">Sets</label>
        <input type="text" name="sets" value="{{ old('sets', $workout->sets) }}" class="input input-bordered w-full">
      </div>

      <div>
        <label class="block font-semibold">Repetitions</label>
        <input type="text" name="repetitions" value="{{ old('repetitions', $workout->repetitions) }}" class="input input-bordered w-full">
      </div>

      <div>
        <label class="block font-semibold">Duration</label>
        <input type="text" name="duration" value="{{ old('duration', $workout->duration) }}" class="input input-bordered w-full">
      </div>

      <button type="submit" class="btn btn-primary">Save Changes</button>
      <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</x-app-layout>

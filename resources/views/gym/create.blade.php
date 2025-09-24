<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-center text-pink-500">
            Let us know your workout plan...
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-8 mt-6 bg-white rounded-2xl shadow-lg border border-gray-100">
        <form action="{{ route('gym') }}" method="POST" class="space-y-10">
            @csrf

            @if ($errors->any())
                <div class="alert alert-error rounded-lg shadow-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Your Info -->
            <div>
                <h3 class="text-xl font-semibold text-pink-600 flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Your Info
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Goal -->
                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Goal</label>
                        <input type="text" name="goal"
                               value="{{ old('goal', $user->goal ?? '') }}"
                               placeholder="Lose weight, gain muscle..."
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>


                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Current Weight (kg)</label>
                        <input type="number" name="current_weight"
                               value="{{ old('current_weight', $user->current_weight ?? '') }}"
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>

                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Target Weight (kg)</label>
                        <input type="number" name="target_weight"
                               value="{{ old('target_weight', $user->target_weight ?? '') }}"
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>
                </div>
            </div>


            <div>
                <h3 class="text-xl font-semibold text-pink-600 flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                    </svg>
                    Exercise Plan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Fitness Level</label>
                        <select name="fitness_level" class="select select-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400">
                            <option disabled selected>Select one</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>


                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Days per Week</label>
                        <input type="number" name="days_per_week"
                               placeholder="e.g. 4"
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>


                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Session Duration (minutes)</label>
                        <input type="number" name="session_duration"
                               placeholder="e.g. 60"
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>


                    <div class="form-control">
                        <label class="label text-sm font-medium text-gray-700">Plan Duration (weeks)</label>
                        <input type="number" name="plan_duration_weeks"
                               placeholder="e.g. 12"
                               class="input input-bordered w-full rounded-xl focus:ring-2 focus:ring-pink-400"/>
                    </div>
                </div>
            </div>


            <input type="hidden" name="preferences[]" value="none">
            <input type="hidden" name="health_conditions[]" value="none">


            <div class="form-control">
                <button type="submit"
                        class="btn bg-pink-500 hover:bg-pink-600 text-white rounded-full w-full py-3 text-lg tracking-wide shadow-md hover:shadow-xl transition-all duration-200">
                    Save and Produce Plan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

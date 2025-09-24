<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-primary">Let us know your workout plan.</h2>
    </x-slot>

    <div class="p-6 bg-base-200 rounded-xl shadow-lg pb-32">
        <form action="{{ route('gym') }}" method="POST" class="space-y-6">
            @csrf
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class="text-xl font-semibold text-secondary">Your Info</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Goal</span>
                    </label>
                    <input type="text" name="goal" value="{{ old('goal', $user->goal ?? '') }}"
                           class="input input-bordered w-full" placeholder="e.g. Lose weight, gain muscle ..."/>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Current Weight (kg)</span>
                    </label>
                    <input type="number" name="current_weight" value="{{ old('current_weight', $user->current_weight ?? '') }}"
                           class="input input-bordered w-full" />
                </div>

                <!-- Target Weight -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Target Weight (kg)</span>
                    </label>
                    <input type="number" name="target_weight" value="{{ old('target_weight', $user->target_weight ?? '') }}"
                           class="input input-bordered w-full" />
                </div>
            </div>

            {{-- Exercise Plan Fields --}}
            <h3 class="text-xl font-semibold text-secondary">Exercise Plan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Fitness Level -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Fitness Level</span>
                    </label>
                    <select name="fitness_level" class="select select-bordered w-full">
                        <option disabled selected>Select one</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <!-- Days Per Week -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Days per Week</span>
                    </label>
                    <input type="number" name="days_per_week" class="input input-bordered w-full"
                           placeholder="e.g. 4" />
                </div>

                <!-- Session Duration -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Session Duration (minutes)</span>
                    </label>
                    <input type="number" name="session_duration" class="input input-bordered w-full"
                           placeholder="e.g. 60" />
                </div>

                <!-- Plan Duration -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Plan Duration (weeks)</span>
                    </label>
                    <input type="number" name="plan_duration_weeks" class="input input-bordered w-full"
                           placeholder="e.g. 12" />
                </div>
            </div>

            {{-- Preferences & Health Conditions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Preferences -->
                <input type="hidden" name="preferences[]" value="none">


                <!-- Health Conditions -->
                <input type="hidden" name="health_conditions[]" value="none">

            </div>

            {{-- Submit --}}
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary btn-lg w-full text-lg tracking-wide shadow-md hover:shadow-xl">
                    Save and Produce Plan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

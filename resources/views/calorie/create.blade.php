<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-primary">Let us know about your nutritional goals..</h2>
    </x-slot>

    <div class="p-6 bg-base-200 rounded-xl shadow-lg pb-32">
        <form action="{{ route('meal') }}" method="POST" class="space-y-6">
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
            <h3 class="text-xl font-semibold text-secondary">Diet Plan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Fitness Level -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Dietary Restrictions</span>
                    </label>
                    <select name="dietary_restrictions" class="select select-bordered w-full">
                        <option disabled selected>Select one</option>
                        <option value="Vegeterian">Vegeterian</option>
                        <option value="Halal">Halal</option>
                        <option value="Carnivore">Carnivore</option>
                        <option value="Vegan">Vegan</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="No dietary requirements">No dietary requirements</option>
                    </select>
                </div>

                <!-- Days Per Week -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Days activity level</span>
                    </label>
                    <select name="daily_activity_level" class="select select-bordered w-full">
                        <option disabled selected>Select one</option>
                        <option value="Sedentary">Sedentary</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Active">Active</option>
                    </select>
                </div>
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

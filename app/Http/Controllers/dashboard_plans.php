<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\exercise;
use App\Models\User;
use App\Models\meal;


class dashboard_plans extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(['workouts', 'food'])->findOrFail(auth()->id());
        return view('dashboard', [
            'workouts' => $user->workouts,
            'meals'    => $user->food,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get the authenticated user with related workouts, meals
        $user = User::with(['workouts', 'food'])->findOrFail(auth()->id());
        return view('dashboard', [
            'workouts' => $user->workouts,
            'meals'    => $user->food,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        //
        if ($request->get('type') === 'meal') {
        $meal = meal::where('user_id', auth()->id())->findOrFail($id);
        return view('edit_meal', compact('meal'));
        }

        $workout = exercise::where('user_id', auth()->id())->findOrFail($id);
        return view('edit_workout', compact('workout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->get('type') === 'meal') {
        $meal = meal::where('user_id', auth()->id())->findOrFail($id);
        $meal->update($request->only(['goal', 'calories_per_day', 'description']));
        return redirect()->route('dashboard.index')
            ->with('success', 'Meal updated successfully.');
        }

        $request->validate([
            'sets' => 'nullable|string|max:10',
            'repetitions' => 'nullable|string|max:10',
            'duration' => 'nullable|string|max:20',
        ]);

        $workout = exercise::where('user_id', auth()->id())->findOrFail($id);
        $workout->update($request->only(['sets', 'repetitions', 'duration']));

        return redirect()->route('dashboard.index')
            ->with('success', 'Workout updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->get('type') === 'meal') {
        $meal = meal::where('user_id', auth()->id())->findOrFail($id);
        $meal->delete();
        return redirect()->route('dashboard.index')
            ->with('success', 'Meal deleted successfully.');
        }

        $workout = exercise::where('user_id', auth()->id())->findOrFail($id);
        $workout->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Workout deleted successfully.');
    }

    public function meal_destroy(string $id)
    {
        //
        $meal = meal::where('user_id', auth()->id())->findOrFail($id);
        $meal->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Meal deleted successfully.');
    }
}

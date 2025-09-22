<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboard_plans extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
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
    public function show()
    {
        //
        // ensure you display:
        // 'target_weight' -> from users table
        // fitness_level -> from exercise_plans table
        // plan_duration_weeks -> from exercise_plans table
        // Whilst the following will be displayed seperately:
        // dietary_restrictions -> from nutrition_plans table
        // daily_activity_level -> from nutrition_plans table
        // two seperate sections on the dashboard for exercise and diet plans.


        // exercise plan section

        if (!\Schema::hasTable('exercise_plans')) {
            // Table does not exist, handle accordingly
            $exercisePlan = null;
        } else {
            $exercisePlan = \DB::table('exercise_plans')
                ->join('users', 'exercise_plans.user_id', '=', 'users.id')
                ->select('users.target_weight', 'exercise_plans.fitness_level', 'exercise_plans.plan_duration_weeks')
                ->where('users.id', auth()->id())
                ->get();
        }
        // if no data found, set to null
        if (!$exercisePlan) {
            $exercisePlan = null;
        }
        // nutrition plan section
        // check if table exists and has data first before querying
        if (!\Schema::hasTable('nutrition_plans')) {
            // Table does not exist, handle accordingly
            $nutritionPlan = null;
        } else {
            $nutritionPlan = \DB::table('nutrition_plans')
                ->join('users', 'nutrition_plans.user_id', '=', 'users.id')
                ->select('nutrition_plans.dietary_restrictions', 'nutrition_plans.daily_activity_level')
                ->where('users.id', auth()->id())
                ->get();
        }
        // if no data found, set to null
        if (!$nutritionPlan) {
            $nutritionPlan = null;
        }


        // return json response in a view.
        return view('dashboard', [
            'exercise_plan' => $exercisePlan,
            'nutrition_plan' => $nutritionPlan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\exercise_plan;
use PhpParser\Node\Expr\AssignOp\Mod;

class ExercisePlanController extends Controller
{
    //

    public function workout_plan(){

        // get database values to send to API
        // Values are:
        // goal, fitness_level, preferences (array), health_conditions (array),
        // schedule (days_per_week, session_duration), plan_duration_weeks,

        // get it from auth user and models

        $user = USer::with('exercise_plan')->find(auth()->id());
        // get values from user and exercise_plan models
        // assuming relationships are set up correctly
        $goal = $user->goal;
        $fitness_level = $user->exercise_plan->fitness_level ?? 'Beginner';
        $preferences = $user->exercise_plan->preferences ?? [];
        $health_conditions = $user->exercise_plan->health_conditions ?? [];
        $days_per_week = $user->exercise_plan->days_per_week ?? 3;
        $session_duration = $user->exercise_plan->session_duration ?? 30;
        $plan_duration_weeks = $user->exercise_plan->plan_duration_weeks ?? 4;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https'://ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com/customWorkoutPlan?noqueue=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'goal' => $goal,
                'fitness_level' => $fitness_level,
                'preferences' => $preferences,
                'health_conditions' => $health_conditions,
                'schedule' => [
                        'days_per_week' => $days_per_week,
                        'session_duration' => $session_duration
                ],
                'plan_duration_weeks' => $plan_duration_weeks,
                'custom_goals' => $goal,
                'lang' => 'en'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com",
                "x-rapidapi-key: 8e0e65ac48mshcbf6a77e9c608ddp168d8cjsn8434ed1bdc8f"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
}
}

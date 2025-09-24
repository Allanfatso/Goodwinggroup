<?php

namespace App\Http\Controllers;

use App\Models\nutrition_plan;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class NutritionPlanController extends Controller
{
    /*



  $goal = $user->goal;
        $plan = $user->exercises()->first();
        $fitness_level = $plan->fitness_level ?? 'Beginner';
        $preferences = $plan->preferences ?? [];
        $health_conditions = $plan->health_conditions ?? [];
        $days_per_week = $plan->days_per_week ?? 3;
        $session_duration = $plan->session_duration ?? 30;
        $plan_duration_weeks = $plan->plan_duration_weeks ?? 4;




    */
    public function meal(Request $request, nutrition_plan $nutri, User $user){

        // get database values to send to API
        // Values are:
        // goal, dietary_preferences (array), allergies (array),
        // daily_caloric_intake, meals_per_day, plan_duration_days,

        // get it from auth user and models

        $user = User::with('nutrition')->findOrFail(auth()->id());

        // get values from user and nutrition_plan models
        $goal = $user->goal;
        $plan = $user->nutrition()->first();
        $dietary_restrictions = $plan->dietary_restrictions ?? [];
        $daily_activity_level = $plan->daily_activity_level ?? 'Moderate';
        $current_weight = $user->current_weight ?? 70;
        $target_weight = $user->target_weight ?? 65;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com/nutritionAdvice?noqueue=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'goal' => $goal,
                'dietary_restrictions' => $dietary_restrictions,
                'current_weight' => $current_weight,
                'target_weight' => $target_weight,
                'daily_activity_level' => $daily_activity_level,
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

        $data = json_decode($response, true);
        dd($data);


    }

    public function calorie_form(){
        return view('calorie.create', ['routine'=> null]);
    }
}

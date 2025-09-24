<?php

namespace App\Http\Controllers;

use App\Models\nutrition_plan;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\meal;

class NutritionPlanController extends Controller
{
    use AuthorizesRequests;
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
        $dietary_restrictions = $plan->dietary_restrictions;
        $daily_activity_level = $plan->daily_activity_level;
        $current_weight = $user->current_weight;
        $target_weight = $user->target_weight;
        //dd($goal, $dietary_restrictions, $daily_activity_level, $current_weight, $target_weight);
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
                'dietary_restrictions' => [$dietary_restrictions],
                'current_weight' => $current_weight,
                'target_weight' => $target_weight,
                'daily_activity_level' => $daily_activity_level,
                'lang' => 'en'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com",
                "x-rapidapi-key: 2cc8b3d677msh8438b67bbde108ep161d40jsn25fc8f63d23f"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return back()->with('error', 'Failed to generate workout plan.');;
        }

        $data = json_decode($response, true);

        //dd($data);

        if (!$data) {
            return back()->with('error', 'Failed to generate workout plan.');
        }
        //save data into meal table
        $result = $data['result'] ?? [];


        $newMeal = meal::updateorcreate([
            'user_id' => $user->id,
            'seo_title' => $result['seo_title'] ?? null,
            'exercise_name' => $result['exercise_name'] ?? null,
            'description' => $result['description'] ?? null,
            'goal' => $result['goal'] ?? null,
            'calories_per_day' => isset($result['calories_per_day']) ? (int)$result['calories_per_day'] : null,
            // if you added $casts to meal model, pass arrays; otherwise wrap with json_encode(...)
            'macronutrients' => $result['macronutrients'] ?? null,
            'meal_suggestions' => $result['meal_suggestions'] ?? null,
        ]);


        // return a view to preview the result (you can use the show_meal view below)
        return view('show_meal', [
            'plan' => $result,
            'savedMeal' => $newMeal,
        ]);


    }


    public function meal_store(Request $request, nutrition_plan $nutri, User $user){
        // validate input
        $validated = $request->validate([
            'goal' => 'required|string|max:255',
            'current_weight' => 'required|numeric|min:30|max:300',
            'target_weight' => 'required|numeric|min:30|max:300',
            'dietary_restrictions' => 'sometimes|nullable|string|max:255',
            'daily_activity_level' => 'required|in:Sedentary,Moderate,Active',
        ]);

        // get user
        $user = User::findOrFail(auth()->id());

        // update user info
        $user->update([
            'goal' => $validated['goal'],
            'current_weight' => $validated['current_weight'],
            'target_weight' => $validated['target_weight'],
        ]);

        // save or update nutrition plan
        $nutrition = nutrition_plan::updateOrCreate(
            ['user_id' => $user->id],
            [
                'dietary_restrictions' => $validated['dietary_restrictions'],
                'daily_activity_level' => $validated['daily_activity_level'],
            ]
        );

        // redirect (adjust route name if you prefer another)
        return redirect()->route('recipe')
            ->with('success', 'Nutrition plan updated successfully!');


    }

    public function calorie_form(){
        return view('calorie.create', ['routine'=> null]);
    }
}

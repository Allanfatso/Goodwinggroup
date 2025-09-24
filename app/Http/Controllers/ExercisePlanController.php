<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\exercise;
use App\Models\exercise_plan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpParser\Node\Expr\AssignOp\Mod;


class ExercisePlanController extends Controller
{
    //
    use AuthorizesRequests;


    public function gym(Request $request, exercise_plan $routine, User $user){

        // get database values to send to API
        // Values are:
        // goal, fitness_level, preferences (array), health_conditions (array),
        // schedule (days_per_week, session_duration), plan_duration_weeks,

        // get it from auth user and models


        $user = User::with('exercises')->findOrFail(auth()->id());
        // get values from user and exercise_plan models
        // assuming relationships are set up correctly
        $goal = $user->goal;
        $plan = $user->exercises()->first();
        $fitness_level = $plan->fitness_level ?? 'Beginner';
        $preferences = $plan->preferences ?? [];
        $health_conditions = $plan->health_conditions ?? [];
        $days_per_week = $plan->days_per_week ?? 3;
        $session_duration = $plan->session_duration ?? 30;
        $plan_duration_weeks = $plan->plan_duration_weeks ?? 4;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com/generateWorkoutPlan?noqueue=1",
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
            return back()->with('error', 'Failed to generate workout plan.');
        }

        $data = json_decode($response, true);


        if (! $data || $data['status'] !== 'success') {
            return back()->with('error', 'Failed to generate workout plan.');
        }

        $result = $data['result'] ?? [];

        //save data into exercises
        if(!empty($result['exercises'])){
            foreach ($result['exercises'] as $day){
                $dayName = $day['day'] ?? 'Day 1';

                foreach($day['exercises'] as $exercise){
                    Exercise::create([
                    'user_id' => $user->id,
                    'day' => $dayName,
                    'name' => $exercise['name'] ?? '',
                    'duration' => $exercise['duration'] ?? null,
                    'repetitions' => $exercise['repetitions'] ?? null,
                    'sets' => $exercise['sets'] ?? null,
                    'equipment' => $exercise['equipment'] ?? null,
                    'description' => null,
                    'additional_info' => null,
                ]);

            }
        }

    }

        return view('show_plan', [
            'plan' => $result
        ]);
    }
    public function gym_form()
    {
        return view('gym.create', ['routine' => null]);
    }


    public function store_gym(Request $request)
    {

   //       Route::get('/lift', [ExercisePlanController::class, 'gym_form'])->name('lift');
   // Route::post('/gym', [ExercisePlanController::class, 'store_gym'])->name('gym');
        // validate input
        $validated = $request->validate([
            'goal' => 'required|string|max:255',
            'current_weight' => 'required|numeric|min:30|max:300',
            'target_weight' => 'required|numeric|min:30|max:300',
            'fitness_level' => 'required|in:Beginner,Intermediate,Advanced',
            'days_per_week' => 'required|integer|min:1|max:7',
            'session_duration' => 'required|integer|min:10|max:180',
            'plan_duration_weeks' => 'required|integer|min:1|max:52',
            'preferences' => 'sometimes|array',
            'preferences.*' => 'string|max:255',
            'health_conditions' => 'sometimes|array',
            'health_conditions.*' => 'string|max:255',
        ]);

        // save to database
        $user = User::find(auth()->id());

        // update user info
        $user->update([
            'goal' => $validated['goal'],
            'current_weight' => $validated['current_weight'],
            'target_weight' => $validated['target_weight'],
        ]);

        // save or update exercise plan
        $exercisePlan = exercise_plan::updateOrCreate(
            ['user_id' => $user->id],
            [
                'fitness_level' => $validated['fitness_level'],
                'days_per_week' => $validated['days_per_week'],
                'session_duration' => $validated['session_duration'],
                'plan_duration_weeks' => $validated['plan_duration_weeks'],
                'preferences' => $validated['preferences'] ?? [],
                'health_conditions' => $validated['health_conditions'] ?? ['none'],
            ]
        );

        return redirect()->route('routine')->with('success', 'Exercise plan updated successfully!');
    }
}

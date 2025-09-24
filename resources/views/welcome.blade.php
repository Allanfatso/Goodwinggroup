<!DOCTYPE html>
<html data-theme="synthwave" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>HealthPlanner</title>
  </head>
  <body class="min-h-screen flex flex-col">

    @if (Route::has('login'))
      <nav class="p-4 flex justify-end gap-4">
        @auth
          {{-- If logged in = go directly to plans --}}
          <a href="{{ route('dashboard') }}" class="btn btn-primary">
             My Plans
          </a>
        @else
          {{-- If not logged in = show login + register --}}
          <a href="{{ route('login') }}" class="btn btn-ghost">
             Log in
          </a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-ghost">
               Register
            </a>
          @endif
        @endauth
      </nav>
    @endif


    <div class="hero bg-base-200 flex-grow">
      <div class="hero-content text-center">
        <div class="max-w-md">
          <h1 class="text-5xl font-bold">Health Planner</h1>
          <p class="py-6">
            Plan your healthy meals, get meal and calorie analysis or get clear results
            from specially curated workout plans fitted to your schedule. Let's get started.
          </p>
          @auth
            {{-- If logged in = plans --}}
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Get Started</a>
          @else
            {{-- If guest = login --}}
            <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
          @endauth
        </div>
      </div>
    </div>


    <div class="dock bg-neutral text-neutral-content">
        <a href="{{ route('meal') }}">
            <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><polyline points="1 11 12 2 23 11" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></polyline><path d="m5,13v7c0,1.105.895,2,2,2h10c1.105,0,2-.895,2-2v-7" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path><line x1="12" y1="22" x2="12" y2="18" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></line></g></svg>
            <span class="dock-label">Meal Plan</span>
        </a>
        <a href="{{ route('calorie') }}">
            <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><polyline points="3 14 9 14 9 17 15 17 15 14 21 14" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></polyline><rect x="3" y="3" width="18" height="18" rx="2" ry="2" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></rect></g></svg>
            <span class="dock-label">Calorie Analysis</span>
        </a>
        <a href="{{ route('lift') }}">
            <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><path d="m22,13.25v-2.5l-2.318-.966c-.167-.581-.395-1.135-.682-1.654l.954-2.318-1.768-1.768-2.318.954c-.518-.287-1.073-.515-1.654-.682l-.966-2.318h-2.5l-.966,2.318c-.581.167-1.135.395-1.654.682l-2.318-.954-1.768,1.768.954,2.318c-.287.518-.515,1.073-.682,1.654l-2.318.966v2.5l2.318.966c.167.581.395,1.135.682,1.654l-.954,2.318,1.768,1.768,2.318-.954c.518.287,1.073.515,1.654.682l.966,2.318h2.5l.966-2.318c.581-.167,1.135-.395,1.654-.682l2.318.954,1.768-1.768-.954-2.318c.287-.518.515-1.073.682-1.654l2.318-.966Z" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path></g></svg>
            <span class="dock-label">Gym Session</span>
        </a>
    </div>

  </body>
</html>

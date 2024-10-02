<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-gray-200 h-screen flex flex-col">
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div>
            <a href="{{ route('home') }}" class="text-white mr-4 hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Inici</a>
            <a href="{{ route("courses.index") }}" class="text-white mr-4 hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Cursos</a>
            @if(Auth::check() && (!Auth::user()->is_professor && !Auth::user()->is_admin))
                <a href="{{ route("studentEnrollment.index") }}" class="text-white mr-4 hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Cursos inscrits</a>
            @endif
            <a href="{{ route("professors.index") }}" class="text-white mr-4 hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Professors</a>
            {{-- <a href="#" class="text-white mr-4 hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Contacte</a> --}}
        </div>
        <div class="flex">
            @guest
                <a href="{{ route('login') }}" class="text-white hover:underline mr-4 text-sm sm:text-sm md:text-md lg:text-lg">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Registre</a>
            @endguest
            {{-- NOTIFICACIÓNS --}}
            @auth
                <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="mr-4 relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                    </svg>
                    @if (Auth::user()->unreadNotifications->isNotEmpty())
                        <div class="absolute block w-3 h-3 bg-red-500 border-2 rounded-full -top-0.5 start-2.5 border-gray-900"></div>
                    @endif
                </button>

                <div id="dropdownNotification" class="z-20 hidden max-h-4/6 max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow bg-gray-800 divide-gray-700 max-h-screen overflow-y-auto" aria-labelledby="dropdownNotificationButton">
                    <div class="block px-4 py-2 text-center rounded-t-lg bg-gray-800 text-white">
                        <p class="font-medium">Notificacións</p>
                        <p class="text-xs py-2 text-gray-400">
                            Clica a la fletxa per marcar el missatge com llegit.
                        </p>
                    </div>


                    <div class="divide-y divide-gray-700">
                        @foreach (Auth::user()->unreadNotifications->reverse() as $notification) 
                            {{-- {{ $notification->unreadNotifications(Auth::user())}} --}}
                            @if (!$notification->read)
                                <div class="flex px-4 py-3 bg-gray-800 hover:bg-gray-700 justify-between">
                                    <div class="w-full ps-3">
                                        <div class="text-sm font-bold mb-1.5 text-gray-400">{{ $notification->course->name }} </span></div>
                                        <div class="text-sm mb-1.5 text-gray-400 break-words">{{ $notification->message }}</div>
                                        <div class="text-xs text-blue-600">{{ $notification->created_at->diffForHumans(null, true) }}</div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route("notification.read", ["notification" => $notification, "user" => Auth::user()]) }}" class="flex items-center text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check" width="20" height="20">
                                                <path d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <a href="{{ route("notification.readAll", ["user" => Auth::user()]) }}" class="block py-2 text-sm font-medium text-center rounded-b-lg bg-gray-800 hover:bg-gray-700 text-white">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 me-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                            </svg>
                            Marcar totes com a llegides
                        </div>
                    </a>
                </div>
            @endauth
            @if (Auth::check() && Auth::user()->is_professor)
                <a href="{{ route("yourCourses.index") }}" class="text-white hover:underline mr-4 text-sm sm:text-sm md:text-md lg:text-lg">Els teus cursos</a>
            @endif
            @if (Auth::check() && Auth::user()->is_admin)
                <a href="{{ route("courses.manage") }}" class="text-white hover:underline mr-4 text-sm sm:text-sm md:text-md lg:text-lg">Gestionar cursos</a>
            @endif
            @if (Auth::check() && Auth::user()->is_admin)
                <a href="{{ route("users.index") }}" class="text-white hover:underline mr-4 text-sm sm:text-sm md:text-md lg:text-lg">Gestionar usuaris</a>
            @endif
            @auth
                <img src="{{ asset(optional(Auth::user()->getMedia('images')->last())->getUrl('thumb')) }}" alt="Foto de perfil de l'usuari {{ Auth::user()->name }}" class="w-8 h-8 rounded-full mr-2">
                <a href="{{ route("profile.index") }}" class="text-white hover:underline mr-4 text-sm sm:text-sm md:text-md lg:text-lg">{{ Auth::user()->username }}</a>
                <a href="{{ route('logout') }}" class="text-white hover:underline text-sm sm:text-sm md:text-md lg:text-lg">Tancar sessió</a>
            @endauth

        </div>
    </nav>

    {{-- <main class="h-full"> --}}
    {{-- <main class="h-full flex items-center justify-center"> --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-2 text-center bottom-0 w-full">
        {{-- <footer class="bg-gray-800 text-white py-2 text-center bottom-0 w-full fixed"> --}}
        &copy; 2023 - 2024 AcademyLink - Tots els drets reservats
    </footer>
</body>

</html>

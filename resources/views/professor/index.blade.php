@extends('layouts.app')

@section('title', 'Professors')

@section('content')
    @foreach (['courseCreatedSuccess', 'courseUpdateSuccess', 'courseDeleteSuccess'] as $sessionKey)
        @if (session()->has($sessionKey))
            <div class="flex items-center justify-center w-full p-4 text-xl text-white bg-green-500">
                <svg class="w-4 h-4 my-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <p class="font-bold mx-2">Success!</p>
                <p>{{ session($sessionKey) }}</p>
            </div>
        @endif
    @endforeach

    <h1 class="text-5xl font-bold text-center text-gray-800 m-10">Professors</h1>

    @if (isset($professors) && count($professors) > 0)
        <div class="grid sm:grid-cols-1 md:grid-cols-2">
            @foreach ($professors as $professor)
                @if($professor->is_professor)
                    <div class="container mx-auto p-8">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    {{-- <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Foto de perfil" class="w-16 h-16 rounded-full mr-4"> --}}
                                    <img src="{{ asset(optional($professor->getMedia('images')->last())->getUrl('thumb')) }}" alt="Foto de perfil" class="w-16 h-16 rounded-full mr-4">
                                    <div>
                                        <h1 class="text-2xl font-semibold">{{ $professor->name }}</h1>
                                        <p class="text-gray-500">{{ getUserType($professor) }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h2 class="text-xl font-semibold mb-4">Informació Personal</h2>
                                    <ul>
                                        <li class="flex items-center mb-2">
                                            <p class="font-bold">Username</p>
                                        </li>
                                        <li class="flex items-center mb-6">
                                            <p>{{ $professor->username }}</p>
                                        </li>
                                        <li class="flex items-center mb-2">
                                            <p class="font-bold">Email</p>
                                        </li>
                                        <li class="flex items-center mb-6">
                                            <p>{{ $professor->email }}</p>
                                        </li>
                                        <li class="flex items-center mb-2">
                                            <p class="font-bold">Data de naixement</p>
                                        </li>
                                        <li class="flex items-center mb-3">
                                            <p>{{ date('d/m/Y', strtotime($professor->birth_date)) }}</p>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    @if ($professor->is_professor)
                                        <h2 class="text-xl font-semibold mb-4">Cursos</h2>
                                        <ul>
                                            @foreach ($professor->courses as $course)
                                                <li class="flex items-center mb-2">
                                                    <a href="{{ route('course.index', ['course' => $course]) }}"
                                                        class="text-blue-700 hover:underline">{{ $course->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <h2 class="text-xl font-semibold mb-4">Cursos inscrits</h2>
                                        <ul>
                                            <li class="flex items-center mb-2"></li>
                                            <li class="flex items-center mb-2"></li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="flex mt-10 items-center justify-center">
                <p class="text-2xl text-blue-700 font-bold">No hi han professors</p>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @foreach (['logoutSuccess', 'loginSuccess'] as $sessionKey)
        @if (session()->has($sessionKey))
            <div class="flex items-center justify-center w-full p-4 text-xl text-white bg-green-500">
                <svg class="w-4 h-4 my-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <p class="font-bold mx-2">Success!</p>
                <p>{{ session($sessionKey) }}</p>
            </div>
        @endif
    @endforeach
    {{-- 
    <div class="p-8">
        <h2 class="text-3xl font-bold mb-4">Benvingut a AcademyLink</h2>
        <p class="text-gray-700">
            Connecta amb tutors i companys d'estudi. Explora cursos i millora les teves habilitats acadèmiques.
        </p>
    </div>     --}}
    <div class="h-full flex items-center justify-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-800 md:text-5xl lg:text-6xl">
                Descobreix els nostres cursos online
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-700 lg:text-xl sm:px-16 lg:px-48 ">
                A AcademyLink, ens centrem en proporcionar cursos en línia que impulsen el teu aprenentatge i t'ajudin a
                créixer professionalment.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{ route("register") }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Comença ara
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="{{ route("courses.index") }}"
                    class="inline-flex justify-center items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    Coneix els nostres cursos
                </a>
            </div>
        </div>
    </div>

@endsection

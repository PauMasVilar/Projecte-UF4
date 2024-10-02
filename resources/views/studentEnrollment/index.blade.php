@extends('layouts.app')

@section('title', 'Cursos inscrits')

@section('content')
    <h1 class="text-5xl font-bold text-center text-gray-800 m-10">Cursos inscrits</h1>

    <div class="mx-auto w-5/6 md:w-5/12">
        <div class="mt-10 mb-4">
            <form action="{{ route("studentEnrollment.search") }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Buscar cursos..." value="{{ $query ?? '' }}" class="p-2 border border-gray-300 focus:outline-none bg-white shadow-md rounded-l w-full">
                <button type="submit" class="p-2 bg-blue-600 hover:bg-blue-700 text-white shadow-md rounded-r transition duration-300 ease-in-out">Buscar</button>
            </form>
        </div>
    </div>

    @if (isset($enrolledCourses) && count($enrolledCourses) > 0)
        <div class="grid sm:grid-cols-1 md:grid-cols-2">
            @foreach ($enrolledCourses as $enrollment)
                <div class="container mx-auto mt-4 p-4">
                    <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-semibold">{{ $enrollment->course->name }}</h1>
                            </div>

                            <div class="flex items-center justify-center h-full">
                                <a href="{{ route("course.index", ["course" => $enrollment->course])}}" class="ml-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <h2 class="text-lg mb-4 mt-2 text-gray-500">{{ $enrollment->course->description }}</h2>

                        <div class="mt-auto">
                            <div class="mb-2">
                                <span class="font-semibold">Duració:</span>
                                <span>{{ $enrollment->course->duration }}h</span>
                            </div>
                            
                            <div class="mb-2">
                                <span class="font-semibold">Data d'inici:</span>
                                <span>{{ $enrollment->course->start_date }}h</span>
                            </div>
                            
                            <div class="mb-2">
                                <span class="font-semibold">Data de fi:</span>
                                <span>{{ $enrollment->course->end_date }}h</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-semibold">Professor:</span>
                                    <a href="{{ route("profile", ["user" => $enrollment->course->user->username]) }}" class="text-blue-700 hover:underline">{{ $enrollment->course->user->name }}</a>
                                </div>
                                <div>
                                    <a href="{{ route("studentEnrollment.delete", ["course" => $enrollment->course, "user" => Auth::user()]) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                                        Cancel·lar inscripció!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else 
        <div class="flex mt-20 items-center justify-center">
            <p class="text-2xl text-blue-700 font-bold">No estàs inscrit a cap curs!</p>
        </div>
    @endif
@endsection

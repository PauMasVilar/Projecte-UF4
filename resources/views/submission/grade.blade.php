@extends('layouts.app')

@section('title', 'Puntuar tasca')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-8/12 sm:w-6/12 md:w-5/12 lg:w-4/12 xl:w-3/12">
            <h2 class="text-2xl font-semibold mb-6">Puntuar tasca</h2>
            <form action="{{ route("taskSubmission.grade", ["submission" => $submission]) }}" method="post">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full px-3 space-x-1">
                        <label for="name" class="text-md tracking-wide text-gray-700 font-bold mb-1">Alumne:</label>
                        <a href="{{ route("profile", ["user" => $submission->user]) }}" class="text-md text-blue-600 hover:text-blue-700 hover:underline transition duration-300 ease-in-out">{{ $submission->user->name }}</a>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full px-3 space-x-1">
                        <label for="name" class="text-md tracking-wide text-gray-700 font-bold mb-1">Tasca:</label>
                        <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $submission]) }}" target="_blank" 
                            class="text-md text-red-600 hover:text-red-700 hover:underline transition duration-300 ease-in-out">
                            {{ $submission->submission }}
                        </a>   
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full px-3">
                        <label for="grade" class="text-md tracking-wide text-gray-700 font-bold mb-1">Puntuació:</label>
                        <select name="grade" id="grade" required>
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Desar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

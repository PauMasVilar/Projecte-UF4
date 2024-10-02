@extends('layouts.app')

@section('title', 'Nou curs')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h2 class="text-2xl font-semibold mb-6">Nou curs</h2>
            <form action="{{ route("course.create") }}" method="post">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full md:w-4/6 px-3 mb-6 md:mb-0">
                        <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nom *</label>
                        <input type="text" id="name" name="name" placeholder="..." value="{{ old("name") }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('name') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>

                    <div class="w-full md:w-2/6 px-3">
                        <label for="duration" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Duració (Hores) *</label>
                        <input type="text" id="duration" name="duration" placeholder="..." value="{{ old("duration") }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('duration') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3">
                        <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descripció *</label>
                        <textarea id="description" name="description" placeholder="..." class="mt-1 p-2 w-full border rounded-md min-h-[150px]">{{ old("description") }}</textarea>
                        @error('description') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="start_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data d'inici *</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old("start_date") }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('start_date') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label for="end_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data de fi *</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old("end_date") }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('end_date') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2 mb-5">Els camps marcats amb un asterisc (*) són obligatoris.</p>
                
                <div class="flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection

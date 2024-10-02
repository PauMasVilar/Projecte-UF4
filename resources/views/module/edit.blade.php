@extends('layouts.app')

@section('title', 'Actualitzar mòdul')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h2 class="text-2xl font-semibold mb-6">Actualitzar mòdul</h2>
            <form action="{{ route("module.edit", ["module" => $module]) }}" method="post">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nom *</label>
                        <input type="text" id="name" name="name" placeholder="..." value="{{ $module->name }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('name') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3">
                        <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descripció *</label>
                        <textarea id="description" name="description" placeholder="..." class="mt-1 p-2 w-full border rounded-md min-h-[250px]">{{ $module->description }}</textarea>
                        @error('description') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2 mb-5">Els camps marcats amb un asterisc (*) són obligatoris.</p>

                <div class="flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Desar canvis</button>
                </div>
            </form>
        </div>
    </div>
@endsection

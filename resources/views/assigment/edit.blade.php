@extends('layouts.app')

@section('title', 'Actualitzar tasca')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h2 class="text-2xl font-semibold mb-6">Actualitzar tasca</h2>
            <form action="{{ route("assigment.edit", ["assigment" => $assigment]) }}" method="post">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3 md:mb-0">
                        <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Titol</label>
                        <input type="text" id="title" name="title" placeholder="..." value="{{ $assigment->title }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('title') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3 md:mb-0">
                        <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descripció</label>
                        <textarea id="description" name="description" placeholder="..." class="mt-1 p-2 w-full border rounded-md min-h-[250px]">{{ $assigment->description }}</textarea>
                        @error('description') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Sense el parse no es posava la data a l'input --}}
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label for="due_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data d'entrega</label>
                        <input type="date" id="due_date" name="due_date" value="{{ \Carbon\Carbon::parse($assigment->due_date)->format('Y-m-d') }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('due_date') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2 mb-5">Els camps marcats amb un asterisc (*) són obligatoris.</p>
                
                <div class="flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Actualitzar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Actualitzar contingut')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h2 class="text-2xl font-semibold mb-6">Actualitzar contingut</h2>
            <form action="{{ route("moduleContent.edit", ["moduleContent" => $moduleContent]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Titol</label>
                        <input type="text" id="title" name="title" placeholder="..." value="{{ $moduleContent->title }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('title') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3">
                        <label for="content" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Contingut</label>
                        <textarea id="content" name="content" placeholder="..." class="mt-1 p-2 w-full border rounded-md min-h-[250px]">{{ $moduleContent->content }}</textarea>
                        @error('content') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="files" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Archius</label>
                    <label class="block text-sm font-medium text-gray-600">ATENCIÓ: Si penjes algun archiu, s'eliminarà els que hi havien guardats anteriorment</label>
                    <input type="file" id="files" name="files[]" multiple class="mt-1 p-2 w-full border rounded-md">
                    @error('files.*') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2">Els camps marcats amb un asterisc (*) són obligatoris.</p>
                <p class="text-sm font-medium text-gray-600">Els arxius penjats només podran ser amb format .pdf.</p>
                <p class="text-sm font-medium text-gray-600 mb-5">Pots penjar diversos arxius.</p>
                
                <div class="flex justify-between items-center">
                    {{-- <a href="{{ route("moduleContent.back") }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">Sortir</a> --}}
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Desar canvis</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Gestionar cursos')

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
    
    <h1 class="text-5xl font-bold text-center text-gray-800 m-10">Cursos</h1>

    <div class="container mx-auto p-8">
        @if (isset($courses) && count($courses) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full border rounded-lg">
                    <thead class="bg-gray-200 text-left border-b">
                        <tr>
                            <th class="border px-4 py-2 text-center">Curs</th>
                            <th class="border px-4 py-2 text-center">ID</th>
                            <th class="border px-4 py-2">Professor</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Descripció</th>
                            <th class="border px-4 py-2 text-center">Duració</th>
                            <th class="border px-4 py-2 text-center">Data d'inici</th>
                            <th class="border px-4 py-2 text-center">Data de fi</th>
                            <th class="border px-4 py-2 text-center">Accions</th>
                            {{-- <th class="border px-4 py-2">Creat al</th>
                            <th class="border px-4 py-2">Actualitzat al</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="border-b transition duration-600 ease-in-out hover:bg-gray-300 dark:border-gray-300 dark:hover:bg-gray-300 transition duration-300 ease-in-out">
                                <td class="whitespace-nowrap px-4 py-2 text-center">
                                    <a href="{{ route("course.index", ["course" => $course]) }}" class="w-6 h-6 mx-1 text-gray-600 hover:text-black inline-block align-middle transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-center">{{ $course->id }}</td>
                                <td class="whitespace-nowrap px-4 py-4">{{ $course->user->name }}</td>
                                <td class="whitespace-pre-line px-4 py-2">{{ $course->name }}</td>
                                <td class="whitespace-normal px-4 py-2">{{ $course->description }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-center">{{ $course->duration }}h</td>
                                <td class="whitespace-nowrap px-4 py-2 text-center"> {{ date('d/m/Y', strtotime($course->start_date)) }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-center"> {{ date('d/m/Y', strtotime($course->end_date)) }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-center">
                                    <div class="flex items-center justify-center h-full">
                                        <a href="{{ route('course.edit', ['course' => $course]) }}" class="flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span class="inline-block">Editar</span>
                                        </a>

                                        <button type="submit" data-modal-target="popup-modal{{ $course->id }}" data-modal-toggle="popup-modal{{ $course->id }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            <span class="inline-block">Eliminar</span>
                                        </button>

                                        <div id="popup-modal{{ $course->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-white">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300 ease-in-out" 
                                                    data-modal-hide="popup-modal{{$course->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-600 w-12 h-12 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        
                                                        <p class="text-lg text-gray-500 dark:text-gray-600">Estas segur que vols eliminar el curs</p>
                                                        <p class="mb-5 text-lg text-gray-500 dark:text-gray-600">{{ $course->name }}?</p>

                                                        <div class="flex justify-center">
                                                            <form action="{{ route('course.delete', ['course' => $course]) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-modal-hide="popup-modal{{$course->id}}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                    Si, estic segur
                                                                </button>                                                            
                                                            </form>

                                                            <button data-modal-hide="popup-modal{{$course->id}}" type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                No, cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="flex items-center justify-center h-full">
                                        <a href="{{ route('course.edit', ['course' => $course]) }}" class="flex items-center space-x-1 text-gray-600 hover:text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span class="inline-block">Editar</span>
                                        </a>

                                        <form action="{{ route('course.delete', ['course' => $course]) }}" method="post" 
                                            onsubmit="return confirm('Estas segur que vols eliminar el curs {{ $course->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                <span class="inline-block">Eliminar</span>
                                            </button>
                                        </form>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No hi han cursos</p>
        @endif
    </div>
    <a href="{{ route("course.create") }}" class="fixed bottom-16 py-2 px-5 text-lg right-6 text-white rounded-md bg-green-600 hover:bg-green-700 transition duration-300 ease-in-out">Afegir nou curs</a>
@endsection

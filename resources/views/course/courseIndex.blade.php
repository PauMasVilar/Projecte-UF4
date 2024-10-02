@extends('layouts.app')

@section('title', $course->name)

@section('content')
    @foreach (['moduleCreatedSuccess', 'moduleUpdateSuccess', 'moduleDeleteSuccess', 'moduleContentCreatedSuccess'] as $sessionKey)
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

    <div class="md:grid md:grid-cols-1 md:w-10/12 lg:w-6/12 mx-auto">
        <div class="container mx-auto mt-8 p-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <a href="{{ route('course.back') }} {{-- {{ url()->previous() }} --}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-8 w-8 text-gray-600 hover:text-black transform rotate-180 transition duration-300 ease-in-out">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <div class="flex items-center justify-center h-full">
                        {{-- En cas d'accedir a la pàgina d'un curs, si el que l'ha obert és el professor d'aquest, mostrarà els botòns per editar i eliminar el curs --}}
                        @if (Auth::check() && ($course->user->id === Auth::user()->id || Auth::user()->is_admin))
                            <a href="{{ route("studentEnrollment.manage", ["course" => $course]) }}" class="flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>                                    
                                <span class="inline-block">Alumnes inscrits</span>
                            </a>

                            <a href="{{ route('course.edit', ['course' => $course]) }}" class="ml-3 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                            
                            <a href="{{ route("module.create", ["course" => $course])}}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="inline-block">Afegir mòdul</span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="h-full">
                        <div class="mt-4">
                            <h1 class="text-3xl font-semibold">{{ $course->name }}</h1>
                        </div>
                    </div>
                </div>

                <h2 class="text-lg mb-4 text-gray-500">{{ $course->description }}</h2>

                <div class="mb-2">
                    <span class="font-semibold">Duració:</span>
                    <span>{{ $course->duration }}h</span>
                </div>

                <div class="mb-2">
                    <span class="font-semibold">Data d'inici:</span>
                    <span>{{ date("d/m/Y", strtotime($course->start_date)) }}</span>
                </div>

                <div class="mb-2">
                    <span class="font-semibold">Data de fi:</span>
                    <span>{{ date("d/m/Y", strtotime($course->end_date)) }}</span>
                </div>

                <div>
                    <span class="font-semibold">Professor:</span>
                    <a href="{{ route('profile', ['user' => $course->user->username]) }}" class="text-blue-700 hover:underline">{{ $course->user->name }}</a>
                </div>
                
                <div class="border-b border-gray-300 w-full mt-8"></div>

                <div class="h-full">
                    {{-- El que fà aixó és comprovar si l'usuari logejat és el creador del curs, administrador o --}}
                    {{-- no està inscrit, entrara dins de l'if i mostrarà el missatge --}}
                    @if (Auth::check() && ($course->user->id !== Auth::user()->id && !Auth::user()->is_admin && !Auth::user()->is_professor) && (!Auth::user()->enrollments->contains('id_course', $course->id)))        
                        <h1 class="mt-8 mb-4 text-3xl font-semibold">Has d'estar inscrit per veure el contingut del curs</h1>
                    @elseif ($course->modules->isEmpty()) 
                        <h1 class="mt-8 mb-4 text-3xl font-semibold">Aquest curs no té cap Mòdul</h1>
                    @else
                        @foreach ($course->modules as $module)
                            <div class="mt-8">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route("module.index", ["module" => $module])}}" class="text-3xl font-semibold text-gray-600 hover:underline hover:text-black transition duration-300 ease-in-out">{{ $module->name }}</a>

                                    <div class="grid items-center justify-center h-full lg:flex">
                                        {{-- En cas d'accedir a la pàgina d'un curs, si el que l'ha obert és el professor d'aquest, mostrarà els botòns per editar i eliminar el curs --}}
                                        @if (Auth::check() && ($course->user->id === Auth::user()->id || Auth::user()->is_admin))
                                            <a href="{{ route("module.edit", ["module" => $module]) }}" class="flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                <span class="inline-block">Editar</span>
                                            </a>

                                            <button type="submit" data-modal-target="popup-modal{{ $module->id }}" data-modal-toggle="popup-modal{{ $module->id }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                <span class="inline-block">Eliminar</span>
                                            </button>

                                            <div id="popup-modal{{ $module->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-white">
                                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300 ease-in-out" 
                                                        data-modal-hide="popup-modal{{$module->id}}">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-600 w-12 h-12 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                            
                                                            <p class="text-lg text-gray-500 dark:text-gray-600">Estas segur que vols eliminar el mòdul</p>
                                                            <p class="mb-5 text-lg text-gray-500 dark:text-gray-600">{{ $module->name }}?</p>

                                                            <div class="flex justify-center">
                                                                <form action="{{ route("module.delete", ["module" => $module]) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" data-modal-hide="popup-modal{{$module->id}}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                        Si, estic segur
                                                                    </button>                                                            
                                                                </form>

                                                                <button data-modal-hide="popup-modal{{$module->id}}" type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                    No, cancelar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route("moduleContent.create", ["module" => $module]) }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                <span class="inline-block">Afegir contingut</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="mb-2">
                                    <span>{{ $module->description }}h</span>
                                </div> --}}
                            </div>
                            <div class="border-b border-gray-300 w-full mt-8"></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', $moduleContent->title)

@section('content')

    @foreach (['moduleCreatedSuccess', 'moduleUpdateSuccess', 'moduleDeleteSuccess', 'assigmentCreatedSucess', 'taskSubmissionStoreSuccess', 'taskSubmissionDeleteSuccess', "assigmentUpdateSuccess", "gradeStoreSuccess", "assigmentDeleteSuccess"] as $sessionKey)
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
                    <a href="{{ route('moduleContent.back') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-8 w-8 text-gray-600 hover:text-black transform rotate-180 transition duration-300 ease-in-out">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <div class="flex items-center justify-center h-full">
                        {{-- En cas d'accedir a la pàgina d'un curs, si el que l'ha obert és el professor d'aquest, mostrarà els botòns per editar i eliminar el curs --}}
                        @if(Auth::check() && $moduleContent->module->course->user->id === Auth::user()->id)
                            <a href="{{ route("moduleContent.edit", ["moduleContent" => $moduleContent]) }}" class="flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                <span class="inline-block">Editar</span>
                            </a>

                            <button type="submit" data-modal-target="popup-modal{{ $moduleContent->id }}" data-modal-toggle="popup-modal{{ $moduleContent->id }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                <span class="inline-block">Eliminar</span>
                            </button>

                            <div id="popup-modal{{ $moduleContent->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-white">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300 ease-in-out" 
                                        data-modal-hide="popup-modal{{$moduleContent->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-600 w-12 h-12 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            
                                            <p class="text-lg text-gray-500 dark:text-gray-600">Estas segur que vols eliminar el contingut</p>
                                            <p class="mb-5 text-lg text-gray-500 dark:text-gray-600">{{ $moduleContent->title }}?</p>

                                            <div class="flex justify-center">
                                                <form action="{{ route("moduleContent.delete", ["moduleContent" => $moduleContent]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-modal-hide="popup-modal{{$moduleContent->id}}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                        Si, estic segur
                                                    </button>                                                            
                                                </form>

                                                <button data-modal-hide="popup-modal{{$moduleContent->id}}" type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                    No, cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Mirarà si el modul del curs te ja una tasca o no --}}
                            {{-- ja que el moduleContent només podrà tenir una tasca --}}
                            @if (!$moduleContent->assigment)
                                <a href="{{ route("assigment.create", ["moduleContent" => $moduleContent])}}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span class="inline-block">Afegir tasca</span>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="h-full">
                        <div class="mt-4 mb-2">
                            <h1 class="text-3xl font-semibold">{{ $moduleContent->title }}</h1>
                        </div>
                    </div>
                </div>
                {{-- Sense el nl2br no imprimeix els \n --}}
                {{-- El e() en teoria evita atacs d'injecció de codi XSS --}}
                <h2 class="text-lg mb-4">{!! nl2br(e($moduleContent->content)) !!}</h2>

                {{-- @foreach($moduleContent->files as $file)
                    <div>
                        <a href="{{ route('download.file', ['filename' => $file->path]) }}" target="_blank">
                            Descargar {{ $file->name }}
                        </a>
                    </div>
                @endforeach --}}
                @foreach($files as $file)
                    <div class="mt-4">
                        {{-- El target _blank obra el fitxer en una nova finestra --}}
                        {{-- <a href="{{ route('view.file', ['file_path' => $file->path]) }}" target="_blank">{{ $file->name }}</a> --}}
                        <a href="{{ route("view.file", ["file" => $file]) }}" target="_blank" class="text-red-600 hover:text-red-700 hover:underline transition duration-300 ease-in-out">{{ $file->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- @if ($moduleContent->assigment && $moduleContent->module->course->user->id === Auth::user()->id/* && !Auth::user()->is_professor && !Auth::user()->is_admin */) --}}
    @if ($moduleContent->assigment && (!Auth::user()->is_professor || $moduleContent->module->course->user->id === Auth::user()->id)/* && !Auth::user()->is_professor && !Auth::user()->is_admin */)
        {{-- @if ($moduleContent->assigment->due_date > now()->endOfDay() || Auth::user()->taskSubmissions->contains('id_assigment', $moduleContent->assigment->id)) --}}
        <div class="md:grid md:grid-cols-1 md:w-10/12 lg:w-6/12 mx-auto">
            <div class="container mx-auto p-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-semibold">{{ $moduleContent->assigment->title }}</h2>
                        @if ($moduleContent->module->course->user->id === Auth::user()->id)
                            <div class="flex items-center justify-center h-full">
                                <a href="{{ route("assigment.edit", ["assigment" => $moduleContent->assigment]) }}" class="flex items-center text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    <span class="inline-block">Editar</span>
                                </a>

                                <button type="submit" data-modal-target="popup-modalAssigment{{ $moduleContent->assigment->id }}" data-modal-toggle="popup-modalAssigment{{ $moduleContent->assigment->id }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    <span class="inline-block">Eliminar</span>
                                </button>

                                <div id="popup-modalAssigment{{ $moduleContent->assigment->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-white">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300 ease-in-out" 
                                            data-modal-hide="popup-modalAssigment{{$moduleContent->assigment->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-600 w-12 h-12 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                
                                                <p class="text-lg text-gray-500 dark:text-gray-600">Estas segur que vols eliminar la tasca</p>
                                                <p class="mb-5 text-lg text-gray-500 dark:text-gray-600">{{ $moduleContent->assigment->title }}?</p>

                                                <div class="flex justify-center">
                                                    <form action="{{ route("assigment.destroy", ["assigment" => $moduleContent->assigment]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-modal-hide="popup-modalAssigment{{$moduleContent->assigment->id}}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                            Si, estic segur
                                                        </button>                                                            
                                                    </form>

                                                    <button data-modal-hide="popup-modalAssigment{{$moduleContent->assigment->id}}" type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                        No, cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- <div class="border-b border-gray-300 w-full my-2"></div> --}}

                    <p class="text-lg mt-1">{{ $moduleContent->assigment->description }}</p>

                    <div class="border-b border-gray-300 w-full my-2"></div>

                    <div class="flex space-x-2">
                        <p class="text-md font-medium">Data màxima d'entrega:</p>
                        <p class="text-md font-medium text-gray-600">{{ date("d/m/Y", strtotime($moduleContent->assigment->due_date)) }} 23:59</p>
                    </div>

                    <div class="border-b border-gray-300 w-full my-2"></div>        
                    
                    @if (!Auth::user()->is_professor && !Auth::user()->is_admin)
                        @if (Auth::user()->taskSubmissions->contains('id_assigment', $moduleContent->assigment->id)) 
                            @php $entregada = true @endphp
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <p class="text-md font-medium mb-1">Tasca entregada el:</p>
                                    <p class="text-md font-medium text-gray-600">{{ date("d/m/Y H:m", strtotime($moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id)->due_date)) }}</p>
                                </div>
                                <div>
                                    {{-- Un cop entregada la tasca, si pasa de la data d'entrega no es podrà eliminar --}}
                                    @if ($moduleContent->assigment->due_date >= now()->setTime(0, 0, 0))
                                        <button type="submit" data-modal-target="popup-modal{{ $moduleContent->assigment->id }}" data-modal-toggle="popup-modal{{ $moduleContent->assigment->id }}" class="ml-2 flex items-center space-x-1 text-gray-600 hover:text-black transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            <span class="inline-block">Eliminar entrega</span>
                                        </button>

                                        <div id="popup-modal{{ $moduleContent->assigment->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-white">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300 ease-in-out" 
                                                    data-modal-hide="popup-modal{{$moduleContent->assigment->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-600 w-12 h-12 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        
                                                        <p class="text-lg text-gray-500 dark:text-gray-600 mb-5">Estas segur que vols eliminar l'entrega realitzada?</p>

                                                        <div class="flex justify-center">
                                                            <form action="{{ route("taskSubmission.delete", ["assigment" => $moduleContent->assigment, "user" => Auth::user()]) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-modal-hide="popup-modal{{$moduleContent->assigment->id}}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                    Si, estic segur
                                                                </button>                                                            
                                                            </form>

                                                            <button data-modal-hide="popup-modal{{$moduleContent->assigment->id}}" type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2 transition duration-300 ease-in-out">
                                                                No, cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <p class="text-md font-medium mb-1">Fitxer entregat:</p>
                                {{-- ModuleContentFile::where('module_content_id', $moduleContent->id)->get() --}}
                                {{-- {{ $moduleContent->assigment->taskSubmissions->where("id_student", Auth::user()->id) }} --}}
                                {{-- {{ $taskSubmission }} --}}
                                {{-- <a href="{{ route("taskSubmission.view", ["taskSubmission" => $taskSubmission]) }}" target="_blank" 
                                    class="text-md text-red-600 hover:text-red-700 hover:underline">
                                    {{ $taskSubmission->submission }}
                                </a> --}}
                                {{-- <a href="{{ route("taskSubmission.view", ["taskSubmission" => $taskSubmission]) }}" target="_blank" 
                                    class="text-md text-red-600 hover:text-red-700 hover:underline">
                                    {{ $taskSubmission->submission }}
                                </a> --}}
                                {{-- @php $submission = $moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id) @endphp
                                {{ $submission }}
                                <br>
                                {{ $submission->getMorphClass() }} --}}

                                {{-- <a href="{{ route("taskSubmission.view", ["taskSubmission" => $submission]) }}" target="_blank" 
                                    class="text-md text-red-600 hover:text-red-700 hover:underline">
                                    CLICAAAAAAAAAAAA
                                </a> --}}
                                <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id)]) }}" target="_blank" 
                                    class="text-md text-red-600 hover:text-red-700 hover:underline transition duration-300 ease-in-out">
                                    {{ $moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id)->submission }}
                                </a>
                                {{-- @foreach ($moduleContent->assigment->taskSubmissions as $submission)
                                    @if ($submission->id_student == Auth::user()->id)
                                        <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $submission]) }}">
                                            {{ $submission->submission }}
                                        </a>
                                    @endif
                                @endforeach --}}

                                    {{-- <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $submission]) }}" target="_blank" 
                                        class="text-md text-red-600 hover:text-red-700 hover:underline">
                                     </a> --}}
                            </div>

                            <div class="flex space-x-2">
                                <p class="text-md font-medium">Nota:</p>       
                                @if ($moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id)->grade)
                                    <p class="text-md font-medium text-gray-600">{{ $moduleContent->assigment->taskSubmissions->firstWhere("id_student", Auth::user()->id)->grade }}/10</p>
                                @else
                                    <p class="text-md font-medium text-gray-600">No corretjit</p>
                                @endif
                            </div>

                        @elseif ($moduleContent->assigment->due_date >= now()->setTime(0, 0, 0))
                            @php $noEntregada = true @endphp
                            <p class="text-md font-medium">No entregada</p>
                        @else
                            @php $tancada = true @endphp
                            <p class="text-md font-medium">Tasca tancada</p>
                        @endif

                        <div class="border-b border-gray-300 w-full my-2"></div>

                        <form action="{{ route("taskSubmission.create", ["assigment" => $moduleContent->assigment, "user" => Auth::user()]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="file" class="block text-sm font-medium text-gray-600">Només s'accepten entregues amb format .pdf.</label>
                                <input type="file" name="file" id="file" class="mt-1 p-2 w-full border rounded-md" @if (isset($tancada) || (isset($entregada))) disabled @endif>
                                @error('file') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center justify-end">
                                @if (isset($tancada) || (isset($entregada))) <button class="text-white px-4 py-2 rounded-md bg-blue-300" disabled>Entregar</button> 
                                @elseif (isset($noEntregada)) <button type="submit" class="text-white px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out">Entregar</button> @endif
                            </div>
                        </form>
                    @else 
                        <div class="flex space-x-2 mb-1">
                            <p class="text-md font-medium">Tasques entregades:</p>
                        </div>
                        
                        @if ($moduleContent->assigment->taskSubmissions->isEmpty())
                            <p class="text-md font-medium text-gray-600">No s'ha realitzat cap entrega</p>
                        @else 
                            @foreach($moduleContent->assigment->taskSubmissions as $submission)
                                <div class="flex space-x-2">
                                    <p class="text-md font-medium mb-1">Alumne:</p>
                                    <a href="{{ route("profile", ["user" => $submission->user]) }}" class="text-md text-blue-600 hover:text-blue-700 hover:underline transition duration-300 ease-in-out">{{ $submission->user->name }}</a>
                                </div>
                                <div class="flex space-x-2">
                                    <p class="text-md font-medium mb-1">Tasca:</p>
                                    <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $submission]) }}" target="_blank" 
                                        class="text-md text-red-600 hover:text-red-700 hover:underline transition duration-300 ease-in-out">
                                        {{ $submission->submission }}
                                    </a>                                
                                </div>
                                <div class="flex space-x-2">
                                    <p class="text-md font-medium mb-1">Nota:</p>
                                    @if ($submission->grade)
                                        <p class="text-md font-medium text-gray-600">{{ $submission->grade }}/10</p>
                                    @else
                                        <p class="text-md font-medium text-gray-600">No corretjit</p>
                                    @endif
                                </div>

                                <a href="{{ route("taskSubmission.grade", ["submission" => $submission])}}" class="flex text-gray-600 hover:text-black hover:underline transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="inline-block">Puntuar tasca</span>                                
                                </a>
                                
                                <div class="border-b border-gray-300 w-full my-2"></div>        
                                {{-- <a href="{{ route("taskSubmission.viewFile", ["taskSubmission" => $submission]) }}" target="_blank" 
                                    class="text-md text-red-600 hover:text-red-700 hover:underline">
                                    {{ $submission->description }}
                                </a> --}}
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>    
    @endif
@endsection

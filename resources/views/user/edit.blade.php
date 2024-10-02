@extends('layouts.app')

@section('title', 'Actualitzar usuari')

@section('content')
    <div class="h-full flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h2 class="text-2xl font-semibold mb-6">Actualitzar usuari</h2>
            <form action="{{ route("user.edit", ["user" => $user]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nom complet *</label>
                        <input type="text" id="name" name="name" placeholder="..." value="{{ $user->name }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('name') <p class="text-6 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="username" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Username *</label>
                        <input type="text" id="username" name="username" placeholder="..." value="{{ $user->username }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('username') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>
                                
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Correu electrònic *</label>
                        <input type="email" id="email" name="email" placeholder="..." value="{{ $user->email }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('email') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="birth_date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data de naixement *</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('birth_date') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" placeholder="..." class="mt-1 p-2 w-full border rounded-md">
                        @error('password') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="password_confirmation" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Confirmar password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="..." class="mt-1 p-2 w-full border rounded-md">
                        @error('password_confirmation') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3">
                        <label for="profile_picture" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Imatge de perfil</label>
                        <input type="file" id="profile_picture" name="profile_picture"{{--  accept="image/*" --}} class="mt-1 p-2 w-full border rounded-md">
                        @error('profile_picture') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2">Els camps marcats amb un asterisc (*) són obligatoris.</p>
                <p class="text-sm font-medium text-gray-600">Si no introduïu cap contrasenya, aquesta no es modificarà.</p>
                <p class="text-sm font-medium text-gray-600 mb-5">Si no seleccioneu cap imatge de perfil, la imatge actual no es modificarà.</p>

                
                <div class="flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Sortir</a>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Desar canvis</button>
                </div>
            </form>
        </div>
    </div>
@endsection

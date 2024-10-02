@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="h-full flex items-center justify-center">
    {{-- <div class="mt-[5vh] flex items-center justify-center"> --}}
        <div class="bg-white p-8 rounded shadow-md w-11/12 sm:w-7/12 md:w-6/12 lg:w-5/12 xl:w-3/12">
            <h2 class="text-2xl font-semibold mb-6">Login</h2>
            <form action="{{ route("login") }}" method="post">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-7">
                    <div class="w-full px-3">
                        <label for="username" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Username *</label>
                        <input type="text" id="username" name="username" placeholder="..." value="{{ old("username") }}" class="mt-1 p-2 w-full border rounded-md">
                        @error('username') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3">
                        <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password *</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="..." class="mt-1 p-2 w-full border rounded-md pr-10">
                            <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 pt-1 flex items-center">
                                <svg id="visibleIcon" class="w-6 h-6 text-gray-600 hover:text-black transition duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg id="hiddenIcon" class="w-6 h-6 text-gray-600 hover:text-black transition duration-300 ease-in-out hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        @error('password') <p class="text-red-600 text-xs italic break-words">{{ $message }}</p> @enderror
                        @if ($errors->has("credentials")) <p class="text-red-600 text-xs italic break-words">{{ $errors->first("credentials") }}</p> @endif
                        </div>
                    </div>
                </div>

                <p class="text-sm font-medium text-gray-600 mt-2 mb-5">Els camps marcats amb un asterisc (*) són obligatoris.</p>

                <div class="flex flex-wrap mb-3">
                    <div class="w-full">
                        <input type="checkbox" name="remember" id="idremember">
                        <label for="idremember">Recordar usuari</label>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <p>No tens compte? <a href="{{ route("register") }}" class="text-blue-700 underline">Registre't aquí!</a></p>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var visibleIcon = document.getElementById('visibleIcon');
        var hiddenIcon = document.getElementById('hiddenIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            visibleIcon.classList.add('hidden');
            hiddenIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            visibleIcon.classList.remove('hidden');
            hiddenIcon.classList.add('hidden');
        }
    }
</script>
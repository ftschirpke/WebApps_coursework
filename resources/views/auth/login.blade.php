<x-navbar active="login"/>
<x-app-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row">
            <div class="justify-content-center flex align-items-center text-align-center">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group input-group-md p-2">
                        <!-- Email Address -->
                        <input class="form-control" id="email" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                    </div>
                    <div class="input-group input-group-md p-2">
                        <!-- Password -->
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password"/>
                    </div>

                    <div class="input-group input-group-md p-2">
                        <!-- Remember Me -->
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-warning col-12" type="submit">Log in</button>
                    </div>

                    <div class="row p-2">
                        @if (Route::has('password.request'))
                            <div class="col text-start">
                                <a class="underline link-warning" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif

                        <div class="col text-end">
                            <a class="underline link-warning" href="{{ route('register') }}">
                                Create an account
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-app-layout>

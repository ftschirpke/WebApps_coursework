<x-navbar active="register"/>
<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group input-group-md p-2">
                <!-- Name -->
                <input class="form-control" id="name" type="text" name="name" placeholder="Full Name" :value="old('name')" required autofocus />
            </div>
            <div class="input-group input-group-md p-2">
                <!-- Email Address -->
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" :value="old('email')" required />
            </div>
            <div class="input-group input-group-md p-2">
                <!-- Password -->
                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
            </div>
            <div class="input-group input-group-md p-2">
                <!-- Confirm Password -->
                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required />
            </div>
            <div class="p-2">
                <button class="btn btn-warning col-12" type="submit">Register</button>
            </div>

            <div class="clearfix p-2">
                <a class="underline link-warning" href="{{ route('login') }}">
                    Already registered?
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

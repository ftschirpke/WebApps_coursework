<x-app-layout>
    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group input-group-md p-2">
                <!-- Email Address -->
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
            </div>
            <div class="input-group input-group-md p-2">
                <!-- Password -->
                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password"/>
            </div>
            <div class="input-group input-group-md p-2">
                <!-- Confirm Password -->
                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required/>
            </div>

            <div class="p-2">
                <button class="btn btn-warning col-12" type="submit">Reset Password</button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>

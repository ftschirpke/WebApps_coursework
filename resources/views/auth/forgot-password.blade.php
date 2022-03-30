<x-navbar active="forgot password"/>
<x-app-layout>
    <x-auth-card>

        <div class="mb-4">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row">
            <div class="justify-content-center flex align-items-center text-align-center">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group input-group-md p-2">
                        <!-- Email Address -->
                        <input class="form-control" id="email" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                    </div>

                    <div class="p-2">
                        <button class="btn btn-warning col-12" type="submit">Email Password Reset Link</button>
                    </div>

                </form>
            </div>
        </div>
    </x-auth-card>
</x-app-layout>

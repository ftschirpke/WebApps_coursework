<x-navbar active="account" :account="$account"/>
<x-app-layout>
    <h1>My Account</h1>
    <div class="row justify-content-evenly">
        <div class="col-6">
            display name:
        </div>
        <div class="col-6">
            {{ $account->display_name }}
        </div>
    </div>
    <div class="row justify-content-evenly">
        <div class="col-6">
            League of Legends account (optional):
        </div>
        <div class="col-6">
            {{ $account->lol_name ? $account->lolInfo() : 'None' }}
        </div>
    </div>

    </div>
</x-app-layout>
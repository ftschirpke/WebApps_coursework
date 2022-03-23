<x-navbar active="account" :account="$account"/>
<x-app-layout>
    <h1>My Account</h1>
    display name: {{ $account->display_name }}
</x-app-layout>
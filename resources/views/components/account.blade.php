<x-navbar active="account" :account="$account"></x-navbar>
<x-layout>
    <h1>My Account</h1>
    display name: {{ $account->display_name }}
</x-layout>
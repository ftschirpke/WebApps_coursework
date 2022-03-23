@props(['name' => 'input', 'disabled' => false])

<input class="rounded-md shadow-sm focus:ring" placeholder="{{ $name }}" {{ $disabled ? 'disabled' : '' }} >

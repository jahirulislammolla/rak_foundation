@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-100 focus:border-indigo-100 focus:ring-indigo-200 rounded-md shadow-sm']) !!}>

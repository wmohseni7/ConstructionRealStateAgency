@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-100 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm']) !!}>

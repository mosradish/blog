@props(['active'])

@php
$defaultClasses = ($active ?? false)
    ? 'inline-flex border-l-8 box-border items-center justify-center border-indigo-400 dark:border-indigo-600 text-base font-medium text-indigo-700 dark:text-indigo-300 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
    : 'inline-flex border-l-8 box-border items-center justify-center border-transparent text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a class="{{ $defaultClasses }} {{ $attributes->get('class') }}" {{ $attributes->except('class') }}>
    {{ $slot }}
</a>
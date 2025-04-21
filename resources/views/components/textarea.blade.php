@props(['value'])
<textarea {{ $attributes->merge(['class' => 'form-control text-white']) }}>{{ trim($value ?? $slot) }}</textarea>

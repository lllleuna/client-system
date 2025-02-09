{{-- Reusable Input Component --}}
@props([
    'label' => '', 
    'name' => '', 
    'value' => '', 
    'type' => 'text', 
    'required' => false, 
    'placeholder' => '', 
    'options' => [],
])

<div class="col-span-full">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @if($type == 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}" 
            class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 placeholder-gray-400 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out py-2 px-4"
            placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
    @elseif($type == 'select')
        <select 
            name="{{ $name }}" 
            id="{{ $name }}" 
            class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out py-2 px-4">
            @foreach($options as $option)
                <option value="{{ $option }}" {{ old($name) == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ old($name, $value) }}" 
            class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 placeholder-gray-400 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out py-2 px-4"
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}>
    @endif
</div>

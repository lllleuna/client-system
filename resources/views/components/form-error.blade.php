@props(['name', 'bag' => 'default'])

@error($name, $bag)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
@props(['active' => true])

<a class="{{ $active ? 'text-blue-800 font-medium' : 'text-gray-600 hover:text-blue-600'}} mx-1 px-1 py-3 text-sm" aria-current="$active ? 'page' : 'false'" {{$attributes}}>
    {{$slot}}    
</a>
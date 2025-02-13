@props(['action'])

<form action="{{ $action }}" method="POST" class="inline-block"
      onsubmit="return confirm('Are you sure you want to delete this training record?');">
    @csrf
    @method('DELETE')
    <button type="submit" 
            class="text-indigo-600 hover:text-indigo-900">
        Delete
    </button>
</form>

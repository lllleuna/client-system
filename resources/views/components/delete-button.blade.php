@props(['action'])

<form action="{{ $action }}" method="POST" class="inline-block"
      onsubmit="return confirm('Are you sure you want to delete this training record?');">
    @csrf
    @method('DELETE')
    <button type="submit" 
            class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg shadow-md 
                   hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 
                   transition duration-200">
        Delete
    </button>
</form>

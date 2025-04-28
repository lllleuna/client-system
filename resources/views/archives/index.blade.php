@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-6">Archives</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Category</th> {{-- Now this is Table Name --}}
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Deleted At</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($archives as $archive)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{ ucfirst(str_replace('_', ' ', $archive->table_name)) }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            @if(isset($archive->firstname))
                                {{ $archive->firstname }} {{ $archive->middlename }} {{ $archive->lastname }}
                            @elseif(isset($archive->plate_no))
                                Plate No: {{ $archive->plate_no }}
                            @else
                                No Name
                            @endif
                        </td>
                        
                        <td class="py-3 px-6 text-left">
                            {{ \Carbon\Carbon::parse($archive->deleted_at)->format('M d, Y') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center gap-2">
                                {{-- Restore Button --}}
                                <form method="POST" action="{{ route('archives.restore', $archive->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-3 rounded">
                                        Restore
                                    </button>
                                </form>

                                {{-- Permanent Delete Button --}}
                                <form method="POST" action="{{ route('archives.permanentDelete', $archive->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure? This cannot be undone.')"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-3 rounded">
                                        Delete
                                    </button>
                                </form> 
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No archived data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

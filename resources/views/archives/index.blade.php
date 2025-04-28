@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-6">Archives</h1>

        <x-error-notif/>
        <x-success-notif/>

        {{-- Category Filter --}}
        <div class="mb-4">
            <label for="categoryFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter by Category:</label>
            <select id="categoryFilter" class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/3">
                <option value="">All Categories</option>
                <option value="members_masterlist">Members</option>
                <option value="coop_units">Units</option>
                <option value="governance">Governance</option>
                <option value="coop_grants">Grants</option>
                <option value="coop_loans">Loans</option>
                <option value="coop_businesses">Businesses</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300" id="archivesTable">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Deleted At</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($archives as $archive)
                        <tr class="border-b border-gray-200 hover:bg-gray-100" data-category="{{ $archive->table_name }}">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ ucfirst(str_replace('_', ' ', $archive->table_name)) }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                @if (isset($archive->firstname))
                                    {{ $archive->firstname }} {{ $archive->middlename }} {{ $archive->lastname }}
                                @elseif (isset($archive->plate_no))
                                    Plate No: {{ $archive->plate_no }}
                                @elseif (isset($archive->source))
                                    Grant: {{ $archive->source }}
                                @elseif (isset($archive->financing_institution))
                                    Loan: {{ $archive->financing_institution }}
                                @elseif (isset($archive->nature_of_business))
                                    Business: {{ $archive->nature_of_business }}
                                @else
                                    N/A
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
                                        <button type="submit"
                                            onclick="return confirm('Are you sure? This cannot be undone.')"
                                            class="bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-3 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- We will handle no data with JS, so no need to output here --}}
                    @endforelse
                </tbody>
            </table>

            {{-- No Data Message (hidden by default) --}}
            <div id="noDataMessage" class="text-center text-gray-500 mt-6 hidden">
                No archived data found.
            </div>
        </div>
    </div>

    {{-- Javascript for filtering --}}
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            let selectedCategory = this.value;
            let rows = document.querySelectorAll('#archivesTable tbody tr');
            let noDataMessage = document.getElementById('noDataMessage');
            let anyVisible = false;

            rows.forEach(row => {
                if (selectedCategory === '' || row.getAttribute('data-category') === selectedCategory) {
                    row.style.display = '';
                    anyVisible = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show "No Data" message if no rows are visible
            if (!anyVisible) {
                document.getElementById('archivesTable').style.display = 'none';
                noDataMessage.classList.remove('hidden');
            } else {
                document.getElementById('archivesTable').style.display = '';
                noDataMessage.classList.add('hidden');
            }
        });
    </script>
@endsection

@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="min-h-screen">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-3">Training History</h1>
            <p class="text-lg text-gray-600">Access your cooperative's training records and certificates.</p>

            <!-- Filter Form -->
            <form method="GET" class="mt-8 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-end gap-4">
                    <div class="flex-1">
                        <label for="training_type" class="block text-sm font-medium text-gray-700 mb-1">Training Type</label>
                        <select id="training_type" name="training_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                            <option value="">All Types</option>
                            <option value="face-to-face" {{ request('training_type') == 'face-to-face' ? 'selected' : '' }}>Face-to-Face</option>
                            <option value="online" {{ request('training_type') == 'online' ? 'selected' : '' }}>Online</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                        <select id="month" name="month" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                            <option value="">All Months</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ request('month') == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-none">
                        <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Apply Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Training Records Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Reference No</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Training Date</th>
                            <th class="px-6 py-4">Submitted Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($trainings as $training)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $training->reference_no }}</td>
                                <td class="px-6 py-4 capitalize">{{ $training->training_type }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'new' => 'bg-blue-100 text-blue-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'completed' => 'bg-purple-100 text-purple-800',
                                            'absent' => 'bg-orange-100 text-orange-800',
                                            'rejected' => 'bg-red-100 text-red-800'
                                        ];
                                        $status = $training->status ?? 'new';
                                        $statusColor = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($training->training_date_time)
                                        <span class="inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($training->training_date_time)->format('F d, Y h:i A') }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 italic">TBA</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($training->created_at)
                                        <span class="inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($training->created_at)->format('F d, Y h:i A') }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 italic">DD Mon YYYY</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                    <p class="font-medium">No training records found</p>
                                    <p class="text-sm mt-1">Try adjusting your filter criteria or check back later</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $trainings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
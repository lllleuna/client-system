@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="min-h-screen p-6 lg:p-8">
        <div class="max-w-4xl mx-auto mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Training History</h1>
            <p class="text-gray-600">Access your cooperative's training records and certificates.</p>

            <form method="GET" class="flex flex-col md:flex-row gap-4 mt-6">
                <select name="training_type" class="border rounded p-2 w-full md:w-1/3">
                    <option value="">All Types</option>
                    <option value="face-to-face" {{ request('training_type') == 'face-to-face' ? 'selected' : '' }}>Face-to-Face</option>
                    <option value="online" {{ request('training_type') == 'online' ? 'selected' : '' }}>Online</option>
                </select>

                <select name="month" class="border rounded p-2 w-full md:w-1/3">
                    <option value="">All Months</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ request('month') == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded p-4">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Reference No</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Training Date</th>
                        {{-- <th class="p-2">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainings as $training)
                        <tr class="border-b">
                            <td class="p-2">{{ $training->reference_no }}</td>
                            <td class="p-2 capitalize">{{ $training->training_type }}</td>
                            <td class="p-2 capitalize">{{ $training->status ?? 'new' }}</td>
                            <td class="p-2">
                                {{ $training->training_date_time ? \Carbon\Carbon::parse($training->training_date_time)->format('F d, Y h:i A') : 'TBA' }}
                            </td>
                            {{-- <td class="p-2">
                                <a href="{{ route('training.history.show', $training->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">No training records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $trainings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

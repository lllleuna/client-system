@extends('layouts.layout')

@section('content')


<div class="max-w-4xl mx-auto p-6">
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Transportation Cooperative Training Registration</h1>
        <p class="text-gray-600">
            To provide knowledge of what is a transportation cooperative and how it operates distinctively from other transport organizations.
            This training is a requirement for the registration of Transportation Cooperatives with CDA pursuant to Rule V, Section 6, Item 5 of
            Implementing Rules and Regulations (IRR) of Republic Act 9520.
        </p>
    </div>

    {{-- Training Selection Form --}}
    {{-- <form action="{{ route('training.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf
         --}}
        {{-- Training Type Selection --}}
        <div class="space-y-4">
            <label class="block text-lg font-medium text-gray-700">Select Training Mode</label>
            <div class="grid md:grid-cols-2 gap-4">
                {{-- Face to Face Option --}}
                <label class="border-2 rounded-lg p-4 cursor-pointer transition-all hover:border-blue-200">
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="training_type" value="face-to-face" class="h-4 w-4 text-blue-600">
                        <span class="font-medium">Face to Face Training</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 pl-6">
                        Attend in-person training sessions at our designated training centers
                    </p>
                </label>

                {{-- Online Platform Option --}}
                <label class="border-2 rounded-lg p-4 cursor-pointer transition-all hover:border-blue-200">
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="training_type" value="online" class="h-4 w-4 text-blue-600">
                        <span class="font-medium">Online Platform</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 pl-6">
                        Participate in virtual training sessions from any location
                    </p>
                </label>
            </div>
        </div>

        {{-- Document Upload Section --}}
        <div class="space-y-4">
            <label class="block text-lg font-medium text-gray-700">Required Documents</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Letter Request signed by the Cooperative’s Chairperson
                        </label>
                        <input
                            type="file"
                            name="letter_of_intent"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                        >
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button
                type="submit"
                class="w-full py-3 px-4 text-white font-medium rounded-lg bg-blue-600 hover:bg-blue-700"
            >
                Submit Registration
            </button>
        </div>
    {{-- </form> --}}
</div>
@endsection
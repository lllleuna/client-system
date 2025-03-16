{{-- resources/views/components/form-progress.blade.php --}}
@props(['currentStep' => 1]) 

<div class="w-full py-4 px-2 bg-white border-b">
    <div class="max-w-7xl mx-auto">
        
        {{-- Progress Indicator --}}
        <div class="flex justify-between items-center mb-4">
            <span class="text-sm font-medium text-gray-700">
                Progress: {{ $currentStep }} of 7
            </span>
            <span class="text-sm font-medium text-blue-600">
                {{ round(($currentStep / 7) * 100) }}% Complete
            </span>
        </div>

        {{-- Stepper Navigation --}}
        <div class="relative">
            {{-- Connection Line (Background for the Steps) --}}
            <div class="absolute top-1/2 h-0.5 w-full bg-gray-200 -translate-y-1/2"></div>

            {{-- Step Labels --}}
            @php
                $steps = [
                    'Basic Information',
                    'Membership',
                    'Units and Franchise',
                    'Operations',
                    'Financial & Business',
                    'Capability Building',
                    'Other Information'
                ];
            @endphp

            <div class="relative flex justify-between">
                @foreach ($steps as $index => $step)
                    @php 
                        $stepNumber = $index + 1;
                        $isCompleted = $currentStep > $stepNumber;
                        $isActive = $currentStep === $stepNumber;
                    @endphp

                    {{-- Step Container --}}
                    <div class="flex flex-col items-center w-1/7">
                        
                        {{-- Step Circle --}}
                        <div class="w-8 h-8 rounded-full flex items-center justify-center relative z-10 transition-all
                            {{ $isCompleted ? 'bg-blue-600 text-white' : ($isActive ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700') }}">
                            
                            @if ($isCompleted)
                                {{-- Checkmark Icon for Completed Steps --}}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                {{-- Step Number --}}
                                {{ $stepNumber }}
                            @endif
                        </div>

                        {{-- Step Label --}}
                        <span class="text-xs mt-2 font-medium text-center
                            {{ $isCompleted || $isActive ? 'text-blue-600' : 'text-gray-500' }}">
                            {{ $step }}
                        </span>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

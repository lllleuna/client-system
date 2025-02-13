<!-- Sidebar Navigation -->
<div class="col-span-3">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold mb-6 text-gray-800">Navigation</h2>
        <nav>
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('membersMasterlist') }}" 
                       class="flex items-center px-4 py-2.5 {{ request()->routeIs('membersMasterlist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                        Cooperative Information
                    </a>
                </li>
                <li>
                    <a href="{{ route('driverMasterlist') }}" 
                       class="flex items-center px-4 py-2.5 {{ request()->routeIs('driverMasterlist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                        Drivers List
                    </a>
                </li>
                <li>
                    <a href="{{ route('traininglist') }}" 
                        class="flex items-center px-4 py-2.5 {{ request()->routeIs('traininglist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                        Trainings
                    </a>
                </li>
                <li>
                    <a href="{{ route('cooperativeowned') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200">
                        Cooperative-Owned Units
                    </a>
                </li>
                <li>
                    <a href="{{ route('individuallyowned') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200">
                        Individually-Owned Units
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

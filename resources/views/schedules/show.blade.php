<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $schedule->title }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('schedules.edit', $schedule) }}" 
                   class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Edit
                </a>
                <a href="{{ route('schedules.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Back to Schedules
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8">
                    <!-- Schedule Details -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Description -->
                            @if($schedule->description)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $schedule->description }}</p>
                                </div>
                            @endif

                            <!-- Date & Time -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Date & Time</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $schedule->start_time->format('l, F j, Y') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $schedule->start_time->format('g:i A') }} - {{ $schedule->end_time->format('g:i A') }}
                                                ({{ $schedule->start_time->diffInHours($schedule->end_time) }} hours)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            @if($schedule->location)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Location</h3>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-gray-700">{{ $schedule->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Recurrence -->
                            @if($schedule->is_recurring)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recurrence</h3>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                            </div>
                                            <p class="text-gray-700">Repeats {{ $schedule->recurrence_pattern }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Status & Priority -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Details</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Status</p>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $schedule->status === 'active' ? 'bg-green-100 text-green-800' : ($schedule->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Priority</p>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $schedule->priority === 'high' ? 'bg-red-100 text-red-800' : ($schedule->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($schedule->priority) }}
                                        </span>
                                    </div>
                                    @if($schedule->kingschat_notification)
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Notifications</p>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                                KingsChat Enabled
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                                <div class="space-y-3">
                                    @if($schedule->status === 'active')
                                        <form method="POST" action="{{ route('schedules.complete', $schedule) }}" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                                Mark as Completed
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('schedules.edit', $schedule) }}" 
                                       class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 mb-3">
                                        Edit Schedule
                                    </a>
                                    
                                    <form method="POST" action="{{ route('schedules.destroy', $schedule) }}" class="w-full" onsubmit="return confirm('Are you sure you want to delete this schedule?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                            Delete Schedule
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Created/Updated Info -->
                            <div class="text-sm text-gray-500">
                                <p>Created: {{ $schedule->created_at->format('M d, Y g:i A') }}</p>
                                @if($schedule->updated_at != $schedule->created_at)
                                    <p>Updated: {{ $schedule->updated_at->format('M d, Y g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

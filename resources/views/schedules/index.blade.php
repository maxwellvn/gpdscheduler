<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Schedules') }}
            </h2>
            <a href="{{ route('schedules.create') }}" 
               class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Schedule
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-6">
                    @if($schedules->count() > 0)
                        <div class="space-y-4">
                            @foreach($schedules as $schedule)
                                <div class="flex items-center justify-between p-6 border border-gray-200 rounded-lg hover:border-indigo-300 transition-colors duration-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-4 h-4 rounded-full {{ $schedule->priority === 'high' ? 'bg-red-500' : ($schedule->priority === 'medium' ? 'bg-yellow-500' : 'bg-green-500') }}"></div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $schedule->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $schedule->start_time->format('M d, Y g:i A') }} - {{ $schedule->end_time->format('g:i A') }}
                                                @if($schedule->location)
                                                    • {{ $schedule->location }}
                                                @endif
                                            </p>
                                            @if($schedule->description)
                                                <p class="text-sm text-gray-500 mt-2">{{ $schedule->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        @if($schedule->kingschat_notification)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                                KingsChat
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $schedule->status === 'active' ? 'bg-green-100 text-green-800' : ($schedule->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $schedule->priority === 'high' ? 'bg-red-100 text-red-800' : ($schedule->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($schedule->priority) }}
                                        </span>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('schedules.show', $schedule) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                View
                                            </a>
                                            <a href="{{ route('schedules.edit', $schedule) }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $schedules->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No schedules yet</h3>
                            <p class="mt-2 text-sm text-gray-500">Get started by creating your first schedule.</p>
                            <div class="mt-6">
                                <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create Schedule
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Schedule') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('schedules.show', $schedule) }}" 
                   class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    View Schedule
                </a>
                <a href="{{ route('schedules.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Back to Schedules
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('schedules.update', $schedule) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-sm font-semibold text-gray-700" />
                            <x-text-input id="title" 
                                class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                                type="text" 
                                name="title" 
                                :value="old('title', $schedule->title)" 
                                required 
                                autofocus
                                placeholder="Enter schedule title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" class="text-sm font-semibold text-gray-700" />
                            <textarea id="description" 
                                name="description" 
                                rows="3"
                                class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                placeholder="Enter schedule description (optional)">{{ old('description', $schedule->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Date and Time -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="start_time" :value="__('Start Date & Time')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="start_time" 
                                    class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                                    type="datetime-local" 
                                    name="start_time" 
                                    :value="old('start_time', $schedule->start_time->format('Y-m-d\TH:i'))" 
                                    required />
                                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="end_time" :value="__('End Date & Time')" class="text-sm font-semibold text-gray-700" />
                                <x-text-input id="end_time" 
                                    class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                                    type="datetime-local" 
                                    name="end_time" 
                                    :value="old('end_time', $schedule->end_time->format('Y-m-d\TH:i'))" 
                                    required />
                                <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" class="text-sm font-semibold text-gray-700" />
                            <x-text-input id="location" 
                                class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" 
                                type="text" 
                                name="location" 
                                :value="old('location', $schedule->location)" 
                                placeholder="Enter location (optional)" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Status, Priority and Options -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <!-- Status -->
                                <div>
                                    <x-input-label for="status" :value="__('Status')" class="text-sm font-semibold text-gray-700" />
                                    <select id="status" 
                                        name="status" 
                                        class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                        <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="completed" {{ old('status', $schedule->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $schedule->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <!-- Priority -->
                                <div>
                                    <x-input-label for="priority" :value="__('Priority')" class="text-sm font-semibold text-gray-700" />
                                    <select id="priority" 
                                        name="priority" 
                                        class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                        <option value="low" {{ old('priority', $schedule->priority) === 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority', $schedule->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority', $schedule->priority) === 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- KingsChat Notification -->
                                <div class="flex items-center">
                                    <input id="kingschat_notification" 
                                        type="checkbox" 
                                        name="kingschat_notification" 
                                        value="1"
                                        {{ old('kingschat_notification', $schedule->kingschat_notification) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-2 transition-all duration-200">
                                    <label for="kingschat_notification" class="ml-3 text-sm font-medium text-gray-700">
                                        Enable KingsChat Notifications
                                    </label>
                                </div>

                                <!-- Recurring -->
                                <div class="flex items-center">
                                    <input id="is_recurring" 
                                        type="checkbox" 
                                        name="is_recurring" 
                                        value="1"
                                        {{ old('is_recurring', $schedule->is_recurring) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-2 transition-all duration-200">
                                    <label for="is_recurring" class="ml-3 text-sm font-medium text-gray-700">
                                        Recurring Event
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Recurrence Pattern (shown when recurring is checked) -->
                        <div id="recurrence_pattern_div" class="{{ old('is_recurring', $schedule->is_recurring) ? '' : 'hidden' }}">
                            <x-input-label for="recurrence_pattern" :value="__('Recurrence Pattern')" class="text-sm font-semibold text-gray-700" />
                            <select id="recurrence_pattern" 
                                name="recurrence_pattern" 
                                class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                <option value="">Select pattern</option>
                                <option value="daily" {{ old('recurrence_pattern', $schedule->recurrence_pattern) === 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ old('recurrence_pattern', $schedule->recurrence_pattern) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ old('recurrence_pattern', $schedule->recurrence_pattern) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ old('recurrence_pattern', $schedule->recurrence_pattern) === 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            <x-input-error :messages="$errors->get('recurrence_pattern')" class="mt-2" />
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('schedules.show', $schedule) }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors duration-200">
                                Cancel
                            </a>
                            <x-primary-button class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:ring-4 focus:ring-indigo-500/50 rounded-xl font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                {{ __('Update Schedule') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/hide recurrence pattern based on recurring checkbox
        document.getElementById('is_recurring').addEventListener('change', function() {
            const recurrenceDiv = document.getElementById('recurrence_pattern_div');
            if (this.checked) {
                recurrenceDiv.classList.remove('hidden');
            } else {
                recurrenceDiv.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>

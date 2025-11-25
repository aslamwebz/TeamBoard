<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Worker Skills</h2>
            <p class="text-gray-600">Manage skills and proficiency for {{ $worker->user->name }}</p>
        </div>
        <a 
            href="{{ route('workers.show', $workerId) }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            Back to Worker
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add Skills</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($allSkills as $skill)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="skill_{{ $skill->id }}" 
                                value="{{ $skill->id }}" 
                                wire:model="selectedSkills"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <label for="skill_{{ $skill->id }}" class="ml-3 block text-sm font-medium text-gray-700">
                                {{ $skill->name }}
                                @if($skill->category)
                                    <span class="text-xs text-gray-500 ml-1">({{ $skill->category }})</span>
                                @endif
                            </label>
                        </div>
                        
                        @if(in_array($skill->id, $selectedSkills))
                            <div class="ml-7 mt-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="proficiency_{{ $skill->id }}" class="block text-sm font-medium text-gray-700">Proficiency Level</label>
                                    <select 
                                        id="proficiency_{{ $skill->id }}" 
                                        wire:model="proficiency.{{ $skill->id }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                                    >
                                        <option value="1">1 - Beginner</option>
                                        <option value="2">2 - Basic</option>
                                        <option value="3">3 - Intermediate</option>
                                        <option value="4">4 - Advanced</option>
                                        <option value="5">5 - Expert</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="notes_{{ $skill->id }}" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <input 
                                        type="text" 
                                        id="notes_{{ $skill->id }}" 
                                        wire:model="notes.{{ $skill->id }}" 
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                                        placeholder="Add notes about this skill..."
                                    />
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <button 
                        wire:click="updateSkills"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Save Skills
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Current Skills</h3>
            </div>
            @if($worker->skills->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Skill
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Proficiency
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($worker->skills as $skill)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $skill->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $skill->category ?: 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-900">{{ $skill->pivot->proficiency_level }}/5</span>
                                            <div class="ml-1 flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $skill->pivot->proficiency_level)
                                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        @if($skill->pivot->notes)
                                            <div class="text-sm text-gray-500 mt-1">{{ $skill->pivot->notes }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button 
                                            wire:click="removeSkill({{ $skill->id }})"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    No skills assigned yet.
                </div>
            @endif
        </div>
    </div>
</div>
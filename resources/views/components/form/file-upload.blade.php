<div
    x-data="{
        multiple: @js($multiple),
        files: [],
        existingFiles: Array.isArray(@js($oldFiles ?? []))
            ? @js($oldFiles ?? [])
            : (@js($oldFiles) ? [@js($oldFiles)] : []),
        inputName: '{{ $name }}',

        handleFiles(event) {
            const selected = Array.from(event.target.files);

            if (!this.multiple) {
                this.files = [];
            }

            selected.forEach(file => {
                this.files.push(file);
            });
        },

        removeFile(index) {
            this.files.splice(index, 1);
        },

        removeExisting(index, path) {
            this.existingFiles.splice(index, 1);

            const methodName = this.inputName + 'RemoveFile';

            if (typeof $wire[methodName] === 'function') {
                $wire[methodName](path);
            }
        },

        fileName(path) {
            return path.split('/').pop();
        }
    }"
    class="bg-white border border-borderColor rounded-md p-3 mb-3"
>
    <label class="text-xs font-medium text-gray-600 mb-1 block">
        {{ $label }}
    </label>

    <div class="flex items-center gap-2">
        <input
            type="file"
            wire:model="{{ $name }}"
            @change="handleFiles"
            class="text-xs"
            {{ $multiple ? 'multiple' : '' }}
            {{ $accept ? 'accept='.$accept : '' }}
        >

        <span class="text-xs text-gray-400">
            {{ $multiple ? 'Multiple' : 'Single' }}
        </span>
    </div>

    {{-- Old Files --}}
    <template x-if="existingFiles.length">
        <div class="mt-2 space-y-1">
            <template x-for="(file, index) in existingFiles" :key="index">
                <div class="flex items-center justify-between text-xs bg-gray-50 px-2 py-1 rounded">
                    <a :href="file"
                       target="_blank"
                       class="text-primary truncate max-w-[150px]"
                       x-text="fileName(file)">
                    </a>

                    <button
                        type="button"
                        @click="removeExisting(index, file)"
                        class="text-red-500"
                    >
                        ✕
                    </button>
                </div>
            </template>
        </div>
    </template>

    {{-- New Files --}}
    <template x-if="files.length">
        <div class="mt-2 space-y-1">
            <template x-for="(file, index) in files" :key="index">
                <div class="flex items-center justify-between text-xs bg-gray-100 px-2 py-1 rounded">
                    <span class="truncate max-w-[150px]" x-text="file.name"></span>

                    <button
                        type="button"
                        @click="removeFile(index)"
                        class="text-red-500"
                    >
                        ✕
                    </button>
                </div>
            </template>
        </div>
    </template>
</div>
<div
    x-data="{
        multiple: @js($multiple),
        files: [],

        handleFiles(event) {
            const selected = Array.from(event.target.files);

            if (!this.multiple) {
                this.files = [];
            }

            selected.forEach(file => {
                file.preview = file.type.startsWith('image/')
                    ? URL.createObjectURL(file)
                    : null;

                this.files.push(file);
            });
        },

        removeFile(index) {
            this.files.splice(index, 1);
        },

        formatSize(bytes) {
            return (bytes / 1024 / 1024).toFixed(2) + ' MB';
        }
    }"
    wire:ignore
    class="bg-white border border-borderColor rounded-md shadow-sm mb-5"
>
    {{-- Header --}}
    <div class="px-5 py-4 border-b border-borderColor">
        <h4 class="text-sm font-semibold text-gray-700">{{ $title }}</h4>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <label class="block text-sm text-gray-600 mb-2">
            {{ $label }}
        </label>

        {{-- Upload Box --}}
        <label
            class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-md cursor-pointer
                   border-gray-300 hover:border-primary transition"
        >
            <input
                type="file"
                class="opacity-0"
                wire:model="{{ $name }}"
                @change="handleFiles($event)"
                {{ $multiple ? 'multiple' : '' }}
                {{ $accept ? 'accept='.$accept : '' }}
            >

            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-5 4v-4m0 0l-2 2m2-2l2 2"/>
            </svg>

            <span class="text-sm text-gray-500">
                Click to upload or drag & drop
            </span>

            <span class="text-xs text-gray-400 mt-1">
                {{ $multiple ? 'Multiple files allowed' : 'Single file only' }}
            </span>
        </label>

        {{-- Preview --}}
        <template x-if="files.length">
            <div class="mt-4 space-y-2">
                <template x-for="(file, index) in files" :key="index">
                    <div class="flex items-center justify-between p-3 border rounded-md">
                        <div class="flex items-center gap-3">
                            <template x-if="file.type.startsWith('image/')">
                                <img :src="file.preview" class="w-10 h-10 rounded object-cover">
                            </template>

                            <div>
                                <p class="text-sm text-gray-700" x-text="file.name"></p>
                                <p class="text-xs text-gray-400" x-text="formatSize(file.size)"></p>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="removeFile(index)"
                            class="text-red-500 hover:text-red-700 text-sm"
                        >
                            ✕
                        </button>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
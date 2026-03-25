<div x-data="{
    multiple: @js($multiple ?? false),
    files: [],
    previewUrls: {},
    existingFiles: Array.isArray(@js($oldFiles ?? [])) ?
        @js($oldFiles ?? []) :
        ((@js($oldFiles) && @js($oldFiles) !== null) ? [@js($oldFiles)] : []),
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
        const file = this.files[index];
        const previewKey = this.previewKey(file);

        if (this.previewUrls[previewKey]) {
            URL.revokeObjectURL(this.previewUrls[previewKey]);
            delete this.previewUrls[previewKey];
        }

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
    },

    extension(value) {
        const name = value instanceof File ? value.name : this.fileName(value);
        const parts = name.split('.');
        return parts.length > 1 ? parts.pop().toLowerCase() : '';
    },

    previewKey(file) {
        return [file.name, file.size, file.lastModified].join('-');
    },

    previewUrl(file) {
        const key = this.previewKey(file);

        if (!this.previewUrls[key]) {
            this.previewUrls[key] = URL.createObjectURL(file);
        }

        return this.previewUrls[key];
    },

    isImage(value) {
        if (value instanceof File) {
            return value.type.startsWith('image/');
        }

        return ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'].includes(this.extension(value));
    },

    isPdf(value) {
        if (value instanceof File) {
            return value.type === 'application/pdf';
        }

        return this.extension(value) === 'pdf';
    },

    fileBadge(value) {
        if (this.isPdf(value)) {
            return 'PDF';
        }

        const ext = this.extension(value);
        return ext ? ext.toUpperCase() : 'FILE';
    }
}" class="bg-white border border-borderColor rounded-md p-3 mb-3">
    <label class="text-xs font-medium text-gray-600 mb-1 block">
        {{ $label }}
    </label>

    <div class="flex items-center gap-2">
        <input type="file" wire:model="{{ $name }}" @change="handleFiles" class="text-xs"
            {{ $multiple ? 'multiple' : '' }} {{ $accept ? 'accept=' . $accept : '' }}>

        {{-- <span class="text-xs text-gray-400">
            {{ $multiple ? 'Multiple' : 'Single' }}
        </span> --}}
    </div>

    {{-- Old Files --}}
    <template x-if="existingFiles.length">
        <div class="mt-2 space-y-1">
            <template x-for="(file, index) in existingFiles" :key="index">
                <div class="flex items-center justify-between gap-3 text-xs bg-gray-50 px-2 py-2 rounded">
                    <div class="flex items-center gap-3 min-w-0">
                        <template x-if="isImage(file)">
                            <img :src="file" alt="Preview" class="w-12 h-12 object-cover rounded border border-gray-200 shrink-0">
                        </template>

                        <template x-if="!isImage(file)">
                            <div class="w-12 h-12 rounded border border-gray-200 bg-white flex items-center justify-center text-[11px] font-semibold text-gray-600 shrink-0"
                                x-text="fileBadge(file)"></div>
                        </template>

                        <div class="min-w-0">
                            <a :href="file" target="_blank" class="text-primary truncate max-w-37.5 block"
                                x-text="fileName(file)"></a>
                            <span class="text-[11px] text-gray-400" x-text="isImage(file) ? 'Image preview' : (isPdf(file) ? 'PDF document' : 'Document file')"></span>
                        </div>
                    </div>

                    <button type="button" @click="removeExisting(index, file)" class="text-red-500 shrink-0">
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
                <div class="flex items-center justify-between gap-3 text-xs bg-gray-100 px-2 py-2 rounded">
                    <div class="flex items-center gap-3 min-w-0">
                        <template x-if="isImage(file)">
                            <img :src="previewUrl(file)" alt="Preview" class="w-12 h-12 object-cover rounded border border-gray-200 shrink-0">
                        </template>

                        <template x-if="!isImage(file)">
                            <div class="w-12 h-12 rounded border border-gray-200 bg-white flex items-center justify-center text-[11px] font-semibold text-gray-600 shrink-0"
                                x-text="fileBadge(file)"></div>
                        </template>

                        <div class="min-w-0">
                            <span class="truncate max-w-37.5 block" x-text="file.name"></span>
                            <span class="text-[11px] text-gray-400" x-text="isImage(file) ? 'Image preview' : (isPdf(file) ? 'PDF document' : 'Document file')"></span>
                        </div>
                    </div>

                    <button type="button" @click="removeFile(index)" class="text-red-500 shrink-0">
                        ✕
                    </button>
                </div>
            </template>
        </div>
    </template>
</div>

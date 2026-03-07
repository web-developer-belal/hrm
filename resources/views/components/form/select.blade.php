<div class="w-full">
    @if ($label)
        <label class="block mb-1 text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($isRequired)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if (!$search && !$isMultiple)

        {{-- Native Select --}}
        <select
            name="{{ $isMultiple ? $name.'[]' : $name }}"
            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $class ?? '' }} @error($name) border-red-500 @enderror"
            @if ($live)
                wire:model.live.debounce.500ms="{{ $name }}"
            @else
                wire:model="{{ $name }}"
            @endif
            @if ($isRequired) required @endif
        >
            @if($placeholder ?? false)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $index => $item)
                <option value="{{ $index }}">
                    {{ $item }}
                </option>
            @endforeach
        </select>

    @else

        {{-- Custom Alpine Select --}}
        <div
            x-data="{
                open: false,
                multiple: {{ $isMultiple ? 'true' : 'false' }},
                placeholder: @js($placeholder ?? 'Select option'),

                selected: @entangle($name).live,
                search: @entangle($name . '_search').live,
                options: @entangle($name . '_options').live,

                toggle() { this.open = !this.open },
                close() { this.open = false },

                select(value) {
                    if (this.multiple) {
                        if (!Array.isArray(this.selected)) this.selected = []

                        if (this.selected.includes(value)) {
                            this.selected = this.selected.filter(v => v !== value)
                        } else {
                            this.selected.push(value)
                        }
                    } else {
                        this.selected = value
                        this.close()
                    }
                },

                isSelected(value) {
                    return this.multiple
                        ? this.selected?.includes(value)
                        : this.selected === value
                },

                selectAll() {
                    if (this.multiple) {
                        this.selected = Object.keys(this.options ?? {}).map(v => parseInt(v) || v)
                    }
                },

                clearAll() {
                    if (this.multiple) {
                        this.selected = []
                    }
                },

                get selectedItems() {
                    if (!this.multiple || !this.selected?.length) return []

                    return this.selected.map(v => ({
                        value: v,
                        label: this.options?.[v] ?? v
                    }))
                },

                get displaySelected() {
                    return this.selectedItems.slice(0, 3)
                },

                get extraCount() {
                    return Math.max(0, this.selectedItems.length - 3)
                },

                get hasValue() {
                    return this.multiple
                        ? this.selected?.length > 0
                        : this.selected !== null && this.selected !== ''
                },

                get selectedLabel() {
                    return this.options?.[this.selected] ?? ''
                }
            }"
            class="relative"
            @click.outside="close()"
        >

            {{-- Select Box --}}
            <div
                @click="toggle()"
                class="w-full min-h-[42px] rounded-md border border-gray-300 px-3 py-2 text-sm bg-white cursor-pointer flex items-center justify-between focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 @error($name) border-red-500 @enderror"
            >
                <div class="flex flex-wrap gap-1 items-center relative">

                    {{-- Placeholder --}}
                    <template x-if="!hasValue">
                        <span class="text-gray-400" x-text="placeholder"></span>
                    </template>

                    {{-- Single --}}
                    <template x-if="!multiple && hasValue">
                        <span x-text="selectedLabel"></span>
                    </template>

                    {{-- Multiple --}}
                    <template x-if="multiple">
                        <template x-for="item in displaySelected" :key="item.value">
                            <span class="px-2 py-0.5 text-xs rounded bg-indigo-100 text-indigo-700 inline-flex items-center gap-1">
                                <span x-text="item.label"></span>
                                <button
                                    type="button"
                                    @click.stop="select(item.value)"
                                    class="hover:opacity-70"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.3 5.71a1 1 0 0 0-1.41 0L12 10.59 7.11 5.7A1 1 0 1 0 5.7 7.11L10.59 12 5.7 16.89a1 1 0 0 0 1.41 1.41L12 13.41l4.89 4.89a1 1 0 0 0 1.41-1.41L13.41 12l4.89-4.89a1 1 0 0 0 0-1.4Z"/>
                                    </svg>
                                </button>
                            </span>
                        </template>
                    </template>

                    {{-- +N more --}}
                    <template x-if="extraCount > 0">
                        <span class="text-xs text-gray-500">
                            +<span x-text="extraCount"></span> more
                        </span>
                    </template>

                </div>

                <template x-if="multiple && open">
                    <div class="flex gap-1 right-2 absolute top-1/2 -translate-y-1/2" @click.stop>
                        <button
                            type="button"
                            @click="selectAll()"
                            class="px-2 py-1 text-xs rounded border border-gray-300 text-gray-600 hover:bg-gray-50"
                        >
                            All
                        </button>
                        <button
                            type="button"
                            @click="clearAll()"
                            class="px-2 py-1 text-xs rounded border border-gray-300 text-gray-600 hover:bg-gray-50"
                        >
                            Clear
                        </button>
                    </div>
                </template>

                {{-- Arrow --}}
                <svg class="w-4 h-4 text-gray-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            {{-- Dropdown --}}
            <div
                x-show="open"
                x-transition
                class="absolute z-50 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto"
                style="display: none;"
            >
                {{-- Search --}}
                @if ($search)
                    <div class="p-2 border-b">
                        <input
                            type="text"
                            x-model="search"
                            placeholder="Search..."
                            class="w-full rounded-md border border-gray-300 px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                    </div>
                @endif

                <ul class="py-1">
                    <template x-for="(label, value) in options" :key="value">
                        <li
                            @click="select(value)"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-indigo-50"
                            :class="{ 'bg-indigo-100': isSelected(value) }"
                            x-text="label"
                        ></li>
                    </template>
                </ul>
            </div>

        </div>

    @endif

    {{-- Error --}}
    @error($name)
        <small class="text-red-500 text-sm mt-1 block">
            {{ $message }}
        </small>
    @enderror
</div>

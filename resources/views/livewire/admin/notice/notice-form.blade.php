<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEdit ? 'Edit Notice' : 'Create Notice' }}</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li><span class="text-default">/</span></li>
                    <li class="text-xs text-default">
                        {{ $isEdit ? 'Edit Notice' : 'Create Notice' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap">
            <div class="mb-2">
                <a href="{{ route('admin.notice.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-list me-2"></i>Notices
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->


    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">
                    {{ $isEdit ? 'Edit Notice' : 'Create Notice' }}
                </h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    {{-- Notice Title --}}
                    <x-form.input label="Notice Title" name="title" :is_required="true" :error="true"
                        placeholder="Enter Notice Title" />

                    {{-- Branch --}}
                    <x-form.select label="Select Branch" name="branch_id" live="true" :is_required="true"
                        :error="true" :options="$branches" />

                    {{-- Department --}}
                    <x-form.select label="Select Department" name="department_id" :is_required="false" :error="true"
                        :options="$departments" />

                    {{-- Status --}}
                    <x-form.select label="Status" name="status" :is_required="true" :error="true"
                        :options="['1' => 'Active', '0' => 'Inactive']" />

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <x-form.textarea label="Notice Description" name="description" :is_required="true"
                            :error="true" placeholder="Enter Notice Details..." />
                    </div>

                    {{-- Attachments --}}
                    <div class="md:col-span-2">
                        <x-form.input label="Attachments (Image, PDF, DOC)" name="attachments" type="file" multiple
                            :error="true" />
                    </div>

                    {{-- Show Old Attachments (Edit Mode) --}}
                    @if ($isEdit && $notice && $notice->attachments)
                        <div class="md:col-span-2">
                            <label class="font-medium mb-2 block">Existing Attachments</label>

                            <div class="flex flex-col gap-2">

                                @foreach ($notice->attachments as $index => $file)
                                    <div class="flex items-center justify-between bg-gray-100 px-3 py-2 rounded">

                                        {{-- File Name --}}
                                        <div class="flex items-center gap-2">
                                            <i class="ti ti-paperclip text-primary"></i>

                                            <a href="{{ asset(Storage::url($file)) }}" target="_blank"
                                                class="text-sm text-primary hover:underline">
                                                {{ basename($file) }}
                                            </a>
                                        </div>

                                        {{-- Delete Button --}}
                                        <button wire:click="removeAttachment({{ $index }})" type="button"
                                            class="text-danger hover:text-red-700">
                                            <i class="ti ti-trash"></i>
                                        </button>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif

                    {{-- Submit --}}
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

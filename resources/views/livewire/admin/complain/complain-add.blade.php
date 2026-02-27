<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Complain' : 'Create Complain' }}</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">
                        {{ $isEditMode ? 'Edit Complain' : 'Create Complain' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.complain.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Complain
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Complain' : 'Create Complain' }}</h5>


 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
 @endif

            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="submitComplain" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <!-- Branch -->
                    <x-form.select label="Select Branch" name="branch_id" :is_required="true" :error="true"
                        :options="$branches" />

                    <!-- Employees -->
                    <x-form.select label="Complainant Employee" name="employee_id" :is_required="true" :error="true"
                        :options="$employeesData" :is_multiple="false" :live="false"/>

                        <!-- Employees -->
                    <x-form.select label="Against Employee" name="against_employee_id" :is_required="true" :error="true"
                        :options="$employeesData" :is_multiple="false" :live="false"/>

                    <x-form.input label="Complain Subject" name="subject" :is_required="true" :error="true"
                        placeholder="Enter complain Subject" />
                    <x-form.input
                        label="Date"
                        name="date"
                        :is_required="true"
                        :error="true"
                        type="date" />


                     <x-form.textarea
                        label="Describe your Complain"
                        name="description"
                        :is_required="false"
                        :error="true"
                        placeholder="Describe your complain" />

                        <x-form.input
                        label="Document"
                        name="document"
                        :error="true"

                        type="file"
                        />
                        @if ($oldDocument)
                            <img src="{{ customAsset($oldDocument) }}" height="200" width="200">
                        @endif
                        @if ($document)
                            <img src="{{ $document->temporaryUrl()}}" height="200" width="200">
                        @endif


                    <!-- Status -->
                    <x-form.select label="Status" name="status" :is_required="true" :error="true"
                        :options="['0' => 'Pending', '1' => 'Resolve', '2'=> 'Rejected']" />

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

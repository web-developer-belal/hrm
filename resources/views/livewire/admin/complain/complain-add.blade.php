<div>
    <div class="card bg-white border rounded shadow-sm mb-6">
        <div class="card-header p-5 border-b">
            <h5 class="text-lg font-semibold">{{ $isEditMode ? 'Edit Complain' : 'Create Complain' }}</h5>
        </div>

        <div class="card-body p-5">
            <form wire:submit.prevent="submitComplain" class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Branch -->
                <x-form.select 
                    label="Select Branch" 
                    name="branch_id" 
                    :options="$branches" 
                    :is_required="true"
                    :live="true" />

                <!-- Employees -->
                <x-form.select 
                    label="Complainant Employee" 
                    name="employee_id" 
                    :options="$employeesData" 
                    :is_required="true" />

                <!-- Against Employee (nullable) -->
                <x-form.select 
                    label="Against Employee" 
                    name="against_employee_id" 
                    :options="$employeesData" 
                    :is_required="false" />

                <!-- Subject -->
                <x-form.input 
                    label="Complain Subject" 
                    name="subject" 
                    placeholder="Enter complain subject" 
                    :is_required="true" />

                <!-- Date -->
                <x-form.input 
                    label="Date" 
                    name="date" 
                    type="date" 
                    :is_required="true" />

                <!-- Description -->
                <x-form.textarea 
                    label="Describe your Complain" 
                    name="description" 
                    placeholder="Describe your complain" 
                    :is_required="false" />

                <!-- Documents -->
                <x-form.file-upload 
                    title="Documents" 
                    label="Upload Files" 
                    name="documents" 
                    multiple 
                    accept=".pdf,.doc,.docx,.jpg,.png" />

                <!-- Show old documents -->
                @if(!empty($oldDocument))
                    <div class="col-span-2 mt-2 space-y-1">
                        <label class="text-sm font-semibold">Existing Documents:</label>
                        <ul>
                            @foreach($oldDocument as $doc)
                                <li><a href="{{ asset('storage/'.$doc) }}" target="_blank">{{ basename($doc) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Status -->
                <x-form.select 
                    label="Status" 
                    name="status" 
                    :options="['0'=>'Pending','1'=>'Resolved','2'=>'Rejected']" 
                    :is_required="true" />

                <!-- Submit -->
                <div class="md:col-span-2 text-end">
                    <x-form.button type="submit" :label="$isEditMode ? 'Update' : 'Create'" />
                </div>

            </form>
        </div>
    </div>
</div>
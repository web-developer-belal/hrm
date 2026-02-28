<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Create Adjustment</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('employee.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">
                        Create Adjustment
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('employee.loan') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->



    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Loan Create</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="saveLoan" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <x-form.input label="Amount" name="amount" :is_required="true" :live="true" :error="true"
                        type="text" />

                    <x-form.input label="Installment" name="installment" :is_required="true" :live="true"
                        :error="true" type="number" />

                    <x-form.input label="Emi Amount" name="emiAmount" :is_required="true" :error="true"
                        type="text" />


                    <x-form.input label="Start Month" name="startMonth" :is_required="true" :error="true"
                        type="date" />


                    <x-form.textarea label="Note" name="note" :is_required="false" :error="true" />




                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

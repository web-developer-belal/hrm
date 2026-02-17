

<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payrool Engine</h2>
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
                      Run Payrool
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="#"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Last Month Payroll
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Run Payrool Engine Branchwise</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="generateBranch"
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                      <div class="w-full">
                      <label>Branch</label>
                       <select wire:model="branch_id" class="form-control" required>
                            <option value="" selected  >Select</option>
                      @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }}
                            </option>
                        @endforeach

                    </select>
              @error($branch_id)
                            <small class="text-danger">
                 {{$message}}
            </small>
                    @enderror
                </div>

                      <div class="w-full">
                      <label>Year</label>
                       <select wire:model="year" class="form-control" required>
                        @for($y = now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
               @error($year)
                            <small class="text-danger">
                 {{$message}}
            </small>
                    @enderror
                </div>
                      <div class="w-full">
                      <label>Month</label>
                       <select wire:model="month" class="form-control" required>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    @error($month)
                            <small class="text-danger">
                 {{$message}}
            </small>
                    @enderror

                </div>


                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>



                </form>
            </div>
        </div>
    </div>
      <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Run Payrool Engine All Employee</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="generateAll"
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">



                      <div class="w-full">
                      <label>Year</label>
                       <select wire:model="year" class="form-control" required>
                        @for($y = now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                     @error($year)
                            <small class="text-danger">
                 {{$message}}
            </small>
                    @enderror
                </div>
                      <div class="w-full">
                      <label>Month</label>
                       <select wire:model="month" class="form-control" required>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                     @error($month)
                            <small class="text-danger">
                 {{$message}}
            </small>
                    @enderror
                </div>


                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>



            <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                 <strong>Important:</strong>
                <ul class="mb-0">
                    <li>Make sure attendance sync is completed.</li>
                    <li>Payroll cannot be regenerated if already exists.</li>
                    <li>Approved payroll cannot be modified.</li>
                </ul>
            </div>
        </div>
</div>





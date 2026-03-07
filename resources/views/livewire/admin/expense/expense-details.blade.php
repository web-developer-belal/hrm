<div>
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h4 class="card-title">Expense Details</h4>
            <a href="{{ route('admin.expenses.index') }}" class="btn btn-light">Back to List</a>
        </div>
        <div class="card-body p-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Branch</h5>
                    <p class="text-base text-gray-800">{{ $expense->branch->name }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Expense Type</h5>
                    <p class="text-base text-gray-800">{{ $expense->type->name }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Expense Name</h5>
                    <p class="text-base text-gray-800">{{ $expense->name }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Amount</h5>
                    <p class="text-base text-gray-800">{{ number_format($expense->amount, 2) }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Date</h5>
                    <p class="text-base text-gray-800">{{ $expense->date->format('F j, Y') }}</p>
                </div>
                @if($expense->note)
                <div class="md:col-span-2">
                    <h5 class="text-sm font-medium text-gray-500">Note/Comment</h5>
                    <p class="text-base text-gray-800 whitespace-pre-wrap">{{ $expense->note }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

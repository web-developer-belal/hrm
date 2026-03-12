<div class="card-body p-0">

    {{-- Print Button --}}
    <div class="p-3 text-end">
        <button onclick="printPayrollTable()" class="px-4 py-2 bg-primary text-white rounded">
            Print Table
        </button>
    </div>

    <div id="payrollPrintSection" class="overflow-x-auto">
        <table class="table w-full border border-gray-300 text-sm">
            <thead class="bg-gray-200 text-gray-900">
                <tr>
                    <th>SL</th>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Period Start</th>
                    <th>Period End</th>

                    {{-- Earnings --}}
                    <th>Basic Salary</th>
                    <th>House Rent</th>
                    <th>Medical</th>
                    <th>Transport</th>
                    <th>Other Allowance</th>
                    <th>Gross Salary</th>

                    {{-- Deductions --}}
                    <th>Provident Fund</th>
                    <th>Tax</th>
                    <th>Loan</th>
                    <th>Other Deduction</th>
                    <th>Total Deduction</th>

                    {{-- Final --}}
                    <th>Net Salary</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($payrolls as $pay)
                    <tr class="border-t">

                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $pay->employee->employee_code ?? '--' }}</td>
                        <td>
                            {{ $pay->employee->first_name ?? '--' }}
                            {{ $pay->employee->last_name ?? '' }}
                        </td>
                        <td>{{ $pay->branch->name ?? ($pay->employee->branch->name ?? '--') }}</td>
                        <td>{{ $pay->period_start ? $pay->period_start->format('d-M-Y') : '--' }}</td>
                        <td>{{ $pay->period_end ? $pay->period_end->format('d-M-Y') : '--' }}</td>

                        {{-- Earnings (Fake fallback if not exists) --}}
                        <td>{{ $pay->basic_salary ?? '10000' }}</td>
                        <td>{{ $pay->house_rent ?? '3000' }}</td>
                        <td>{{ $pay->medical ?? '1000' }}</td>
                        <td>{{ $pay->transport ?? '800' }}</td>
                        <td>{{ $pay->other_allowance ?? '--' }}</td>
                        <td>{{ $pay->gross_salary ?? '14800' }}</td>

                        {{-- Deductions --}}
                        <td>{{ $pay->provident_fund ?? '500' }}</td>
                        <td>{{ $pay->tax ?? '300' }}</td>
                        <td>{{ $pay->loan ?? '--' }}</td>
                        <td>{{ $pay->other_deduction ?? '--' }}</td>
                        <td>{{ $pay->total_deduction ?? '800' }}</td>

                        {{-- Final --}}
                        <td class="font-bold">
                            {{ $pay->net_salary ?? '14000' }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        function printPayrollTable() {
            let printContents = document.getElementById('payrollPrintSection').innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endpush

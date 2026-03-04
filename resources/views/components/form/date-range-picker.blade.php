<div x-data="{
    start: @js($startDate), // ISO date string: '2026-03-02'
    end: @js($endDate),

    init() {
        const self = this;

        function updateLabel(start, end, isInitial = false) {
            self.$refs.input.value =
                start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY');

            if (!isInitial && window.Livewire) {
                Livewire.dispatch('date-range-update', {
                    start: start.format('YYYY-MM-DD'),
                    end: end.format('YYYY-MM-DD'),
                });
            }
        }

        // Parse using ISO format explicitly
        let startDate = moment(this.start, 'YYYY-MM-DD');
        let endDate   = moment(this.end, 'YYYY-MM-DD');

        $(this.$refs.input).daterangepicker({
                startDate: startDate,
                endDate: endDate,
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                }
            },
            (start, end) => updateLabel(start, end, false)
        );

        // Initial label without calling Livewire
        updateLabel(startDate, endDate, true);
    }
}" x-init="init()" class="relative w-full">
    <input type="text" x-ref="input"
        class="block w-full border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm"
        placeholder="dd/mm/yyyy - dd/mm/yyyy" readonly>
</div>
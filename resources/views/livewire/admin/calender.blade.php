<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Calendar</h2>
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
                    <li aria-current="page" class="text-xs text-gray-900">Calendar</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="me-3">
                <x-form.select name="branch" wire:model.live="branch" placeholder="Select branch" :options="$branch_options"
                    :search="true" />
            </div>
            <div class="head-icons ml-2 mb-2">
                <a href="javascript:void(0);"
                    class="border flex items-center justify-center rounded bg-white w-9 h-9 hover:bg-primary hover:text-white hover:border-primary"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse"
                    id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

   

    <div x-data="{
        calendarInstance: null,
        holidayEvents: {{ $holidayEvents }},
        init() {
            this.$nextTick(() => {
                this.initializeCalendar();
            });

            document.addEventListener('livewire:updated', () => {
                this.holidayEvents = holidayEventsData;
                this.initializeCalendar();
            });
        },
        initializeCalendar() {
            var calendarEl = document.getElementById('calendar');

            if (this.calendarInstance) {
                this.calendarInstance.destroy();
            }

            calendarEl.innerHTML = '';

            this.calendarInstance = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: this.holidayEvents,
                eventClick: (info) => {
                    const modalElement = document.getElementById('event_modal');
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                        const eventTitle = document.getElementById('eventTitle');
                        if (eventTitle) {
                            eventTitle.innerText = info.event.title;
                        }
                    }
                },
                editable: false,
                droppable: false
            });

            this.calendarInstance.render();
        }
    }" class="card border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-body p-4">
            <div id="calendar"></div>
        </div>
    </div>


</div>


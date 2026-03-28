<?php
namespace App\Livewire\Admin\Notice;

use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notice;
use App\Mail\NoticeCreated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class NoticeForm extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $notice;

    public $title;
    public $description;
    public $attachments = [];
    public $status      = 1;
    public $branch_id = [];
    public $department_id = [];

    public $branch_id_options     = [];
    public $department_id_options = [];

    public $branch_id_search, $department_id_search;

    public $group;
    public $group_options = [];
    public $group_search;

    /* =========================
       MOUNT
    ==========================*/
    public function mount(?Notice $notice = null)
    {
        $this->loadGroups();
        $this->loadBranches();

        if ($notice && $notice->exists) {

            $this->isEdit = true;
            $this->notice = $notice;

            $this->title         = $notice->title;
            $this->description   = $notice->description;
            $this->status        = $notice->status;
            $this->branch_id     = $notice->branch_id;
            $this->department_id = $notice->department_id;

            // Load departments of selected branch
            $this->loadDepartments();
        }
    }

    public function updatedBranchId()
    {
        $this->department_id = $this->isEdit ? null : [];
        $this->loadDepartments();
    }

    public function loadBranches()
    {
        $this->branch_id_options = Branch::query()
            ->whereHas('departments')
            ->where('status', 'active')
            ->when($this->group, function ($query) {
                $query->where('branch_group_id', $this->group);
            })
            ->when($this->branch_id_search, function ($query) {
                $query->where('name', 'like', '%' . $this->branch_id_search . '%');
            })
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function loadGroups(): void
    {
        $this->group_options = BranchGroup::query()
            ->when($this->group_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->group_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedGroupSearch(): void
    {
        $this->loadGroups();
    }

    public function updatedGroup(): void
    {
        $this->loadBranches();

        if ($this->isEdit) {
            return;
        }

        $this->branch_id = $this->normalizeIds(array_keys($this->branch_id_options));
        $this->loadDepartments();
        $this->department_id = $this->normalizeIds(array_keys($this->department_id_options));
    }

    public function loadDepartments(): void
    {
        $branchIds = $this->normalizeIds($this->branch_id);

        if (! empty($branchIds)) {
            $this->department_id_options = Department::query()
                ->whereIn('branch_id', $branchIds)
                ->when($this->department_id_search, function ($query) {
                    $query->where('name', 'like', '%' . $this->department_id_search . '%');
                })
                ->limit($this->group ? 1000 : 200)
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $this->department_id_options = [];
        }
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranches();
    }

    public function updatedDepartmentIdSearch()
    {
        $this->loadDepartments();
    }

    public function save()
    {
        $rules = [
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ];

        $messages = [
            'group.required'          => 'Please select a branch group.',
            'branch_id.required'      => 'Please select at least one branch.',
            'branch_id.array'         => 'Branch selection is invalid.',
            'branch_id.*.exists'      => 'One or more selected branches are invalid.',
            'department_id.required'  => 'Please select at least one department.',
            'department_id.array'     => 'Department selection is invalid.',
            'department_id.*.exists'  => 'One or more selected departments are invalid.',
        ];

        if ($this->isEdit) {
            $this->validate(array_merge($rules, [
                'branch_id'     => 'required|exists:branches,id',
                'department_id' => 'nullable|exists:departments,id',
            ]));
        } else {
            $this->validate(array_merge($rules, [
                'group'           => 'required|exists:branch_groups,id',
                'branch_id'       => 'required|array|min:1',
                'branch_id.*'     => 'exists:branches,id',
                'department_id'   => 'required|array|min:1',
                'department_id.*' => 'exists:departments,id',
            ]), $messages);
        }

        $attachmentPaths = [];

        // If updating and already has attachments
        if ($this->isEdit && $this->notice->attachments) {
            $attachmentPaths = $this->notice->attachments;
        }

        // Upload new files
        if (! empty($this->attachments)) {
            foreach ($this->attachments as $file) {
                $path              = $file->store('notices', 'public');
                $attachmentPaths[] = $path;
            }
        }

        if ($this->isEdit) {
            Notice::updateOrCreate(
                ['id' => $this->notice->id ?? null],
                [
                    'title'         => $this->title,
                    'description'   => $this->description,
                    'branch_id'     => $this->branch_id,
                    'department_id' => $this->department_id,
                    'status'        => $this->status,
                    'attachments'   => $attachmentPaths,
                ]
            );
        } else {
            $selectedBranchIds = $this->normalizeIds($this->branch_id);
            $selectedDepartments = Department::query()
                ->whereIn('id', $this->normalizeIds($this->department_id))
                ->whereIn('branch_id', $selectedBranchIds)
                ->get(['id', 'branch_id']);

            foreach ($selectedDepartments as $department) {
                $notice = Notice::create([
                    'title'         => $this->title,
                    'description'   => $this->description,
                    'branch_id'     => $department->branch_id,
                    'department_id' => $department->id,
                    'status'        => $this->status,
                    'attachments'   => $attachmentPaths,
                ]);

                $employees = Employee::query()
                    ->where('status', 1)
                    ->where('department_id', $department->id)
                    ->whereNotNull('email')
                    ->get();

                foreach ($employees as $employee) {
                    Mail::to($employee->email)->queue(new NoticeCreated($notice, $employee));
                }
            }
        }

        flash()->success($this->isEdit ? 'Notice Updated Successfully' : 'Notice Created Successfully');

        return redirect()->route('admin.notice.index');
    }

    protected function normalizeIds($value): array
    {
        $values = is_array($value) ? $value : [$value];

        return array_values(array_filter(array_map(function ($item) {
            return is_numeric($item) ? (int) $item : null;
        }, $values)));
    }

    public function removeAttachment($index)
    {
        if (! $this->isEdit || ! $this->notice) {
            return;
        }

        $attachments = $this->notice->attachments ?? [];

        if (isset($attachments[$index])) {

            // Delete file from storage
            if (Storage::disk('public')->exists($attachments[$index])) {
                Storage::disk('public')->delete($attachments[$index]);
            }

            // Remove from array
            unset($attachments[$index]);

            // Reindex array
            $attachments = array_values($attachments);

            // Update database
            $this->notice->update([
                'attachments' => $attachments,
            ]);

            // Refresh notice instance
            $this->notice->refresh();

            flash()->success('Deleted old file.');

        }
    }

    public function render()
    {
        return view('livewire.admin.notice.notice-form');
    }
}

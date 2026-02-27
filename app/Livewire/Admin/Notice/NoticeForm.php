<?php

namespace App\Livewire\Admin\Notice;

use App\Models\Notice;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
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
    public $status = 1;
    public $branch_id;
    public $department_id;

    public $branches = [];
    public $departments = [];

    /* =========================
       MOUNT
    ==========================*/
    public function mount(?Notice $notice = null)
    {
        // Load active branches
        $this->branches = Branch::where('status', 'active')
            ->pluck('name', 'id')->prepend('Select Branch','')
            ->toArray();

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
        $this->department_id = null;
        $this->loadDepartments();
    }

    public function loadDepartments()
    {
        if ($this->branch_id) {
            $this->departments = Department::where('branch_id', $this->branch_id)
                ->pluck('name', 'id')->prepend('Select Department','')
                ->toArray();
        } else {
            $this->departments = [];
        }
    }


    public function save()
    {
        $this->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'branch_id'     => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $attachmentPaths = [];

        // If updating and already has attachments
        if ($this->isEdit && $this->notice->attachments) {
            $attachmentPaths = $this->notice->attachments;
        }

        // Upload new files
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $file) {
                $path = $file->store('notices', 'public');
                $attachmentPaths[] = $path;
            }
        }

        Notice::updateOrCreate(
            ['id' => $this->notice->id ?? null],
            [
                'title'         => $this->title,
                'description'   => $this->description,
                'branch_id'     => $this->branch_id,
                'department_id' => $this->department_id,
                'status'        => $this->status,
                'attachments'   => $attachmentPaths, // saved as array
            ]
        );

        flash()->success($this->isEdit ? 'Notice Updated Successfully' : 'Notice Created Successfully');

        return redirect()->route('admin.notice.index');
    }

    public function removeAttachment($index)
{
    if (!$this->isEdit || !$this->notice) {
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
            'attachments' => $attachments
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

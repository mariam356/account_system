<?php

namespace App\Services;

use App\Models\Branch;

class BranchService
{
    public function getById($id)
    {
        return Branch::findOrFail($id);
    }

    // انشاء فرع
    public function create(array $data)
    {
        return Branch::create($data);
    }

    // تحديث فرع
    public function update($id, array $data)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($data);

        return $branch;
    }

    // حذف فرع
    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->delete();
    }
}

<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\CRUDController;
use App\Models\Loans\Loan;
use Illuminate\Database\Eloquent\Model;

class Controller extends CRUDController
{
    public function getModel(): Model
    {
        return new Loan();
    }

    public function getRules(int $id = null): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'reader_id' => 'required|integer|exists:readers,id',
            'expires_at' => 'required|integer|between:1,180',
        ];
    }

    public function list()
    {
        return $this->getModel()->with(['book', 'reader'])->paginate(10);
    }
}

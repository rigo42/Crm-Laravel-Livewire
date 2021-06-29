<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:gastos']);
        $this->middleware(['expense'])->except('index', 'create');
    }

    public function index(){
        return view('expense.index');
    }

    public function create(){
        $expense = new Expense();
        return view('expense.create', compact('expense'));
    }

    public function show(Expense $expense){
        return view('expense.show', compact('expense'));
    }

    public function edit(Expense $expense){
        return view('expense.edit', compact('expense'));
    }
}

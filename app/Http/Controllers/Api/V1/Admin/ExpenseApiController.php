<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\Admin\ExpenseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseResource(Expense::with(['expense_category'])->get());
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());

        if ($request->input('receipts', false)) {
            $expense->addMedia(storage_path('tmp/uploads/' . $request->input('receipts')))->toMediaCollection('receipts');
        }

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseResource($expense->load(['expense_category']));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        if ($request->input('receipts', false)) {
            if (!$expense->receipts || $request->input('receipts') !== $expense->receipts->file_name) {
                $expense->addMedia(storage_path('tmp/uploads/' . $request->input('receipts')))->toMediaCollection('receipts');
            }
        } elseif ($expense->receipts) {
            $expense->receipts->delete();
        }

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

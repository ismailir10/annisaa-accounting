<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIncomeRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Income;
use App\IncomeCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomes = Income::all();

        return view('admin.incomes.index', compact('incomes'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incomes.create', compact('income_categories'));
    }

    public function store(StoreIncomeRequest $request)
    {
        $income = Income::create($request->all());

        foreach ($request->input('receipts', []) as $file) {
            $income->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('receipts');
        }

        return redirect()->route('admin.incomes.index');
    }

    public function edit(Income $income)
    {
        abort_if(Gate::denies('income_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income->load('income_category');

        return view('admin.incomes.edit', compact('income_categories', 'income'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $income->update($request->all());

        if (count($income->receipts) > 0) {
            foreach ($income->receipts as $media) {
                if (!in_array($media->file_name, $request->input('receipts', []))) {
                    $media->delete();
                }
            }
        }

        $media = $income->receipts->pluck('file_name')->toArray();

        foreach ($request->input('receipts', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $income->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('receipts');
            }
        }

        return redirect()->route('admin.incomes.index');
    }

    public function show(Income $income)
    {
        abort_if(Gate::denies('income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->load('income_category');

        return view('admin.incomes.show', compact('income'));
    }

    public function destroy(Income $income)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncomeRequest $request)
    {
        Income::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

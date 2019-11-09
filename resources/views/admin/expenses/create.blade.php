@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expense.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.expenses.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('expense_category_id') ? 'has-error' : '' }}">
                <label for="expense_category">{{ trans('cruds.expense.fields.expense_category') }}</label>
                <select name="expense_category_id" id="expense_category" class="form-control select2">
                    @foreach($expense_categories as $id => $expense_category)
                        <option value="{{ $id }}" {{ (isset($expense) && $expense->expense_category ? $expense->expense_category->id : old('expense_category_id')) == $id ? 'selected' : '' }}>{{ $expense_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('expense_category_id'))
                    <p class="help-block">
                        {{ $errors->first('expense_category_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                <label for="entry_date">{{ trans('cruds.expense.fields.entry_date') }}*</label>
                <input type="text" id="entry_date" name="entry_date" class="form-control date" value="{{ old('entry_date', isset($expense) ? $expense->entry_date : '') }}" required>
                @if($errors->has('entry_date'))
                    <p class="help-block">
                        {{ $errors->first('entry_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expense.fields.entry_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                <label for="amount">{{ trans('cruds.expense.fields.amount') }}*</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', isset($expense) ? $expense->amount : '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <p class="help-block">
                        {{ $errors->first('amount') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expense.fields.amount_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($expense) ? $expense->description : '') }}">
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expense.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('receipts') ? 'has-error' : '' }}">
                <label for="receipts">{{ trans('cruds.expense.fields.receipts') }}</label>
                <div class="needsclick dropzone" id="receipts-dropzone">

                </div>
                @if($errors->has('receipts'))
                    <p class="help-block">
                        {{ $errors->first('receipts') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expense.fields.receipts_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.receiptsDropzone = {
    url: '{{ route('admin.expenses.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="receipts"]').remove()
      $('form').append('<input type="hidden" name="receipts" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="receipts"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($expense) && $expense->receipts)
      var file = {!! json_encode($expense->receipts) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="receipts" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@stop
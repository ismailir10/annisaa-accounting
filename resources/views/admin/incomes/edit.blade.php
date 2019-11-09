@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.income.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.incomes.update", [$income->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('income_category_id') ? 'has-error' : '' }}">
                <label for="income_category">{{ trans('cruds.income.fields.income_category') }}</label>
                <select name="income_category_id" id="income_category" class="form-control select2">
                    @foreach($income_categories as $id => $income_category)
                        <option value="{{ $id }}" {{ (isset($income) && $income->income_category ? $income->income_category->id : old('income_category_id')) == $id ? 'selected' : '' }}>{{ $income_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('income_category_id'))
                    <p class="help-block">
                        {{ $errors->first('income_category_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                <label for="entry_date">{{ trans('cruds.income.fields.entry_date') }}*</label>
                <input type="text" id="entry_date" name="entry_date" class="form-control date" value="{{ old('entry_date', isset($income) ? $income->entry_date : '') }}" required>
                @if($errors->has('entry_date'))
                    <p class="help-block">
                        {{ $errors->first('entry_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.income.fields.entry_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                <label for="amount">{{ trans('cruds.income.fields.amount') }}*</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', isset($income) ? $income->amount : '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <p class="help-block">
                        {{ $errors->first('amount') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.income.fields.amount_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($income) ? $income->description : '') }}">
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.income.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('receipts') ? 'has-error' : '' }}">
                <label for="receipts">{{ trans('cruds.income.fields.receipts') }}</label>
                <div class="needsclick dropzone" id="receipts-dropzone">

                </div>
                @if($errors->has('receipts'))
                    <p class="help-block">
                        {{ $errors->first('receipts') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.income.fields.receipts_helper') }}
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
    var uploadedReceiptsMap = {}
Dropzone.options.receiptsDropzone = {
    url: '{{ route('admin.incomes.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="receipts[]" value="' + response.name + '">')
      uploadedReceiptsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedReceiptsMap[file.name]
      }
      $('form').find('input[name="receipts[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($income) && $income->receipts)
          var files =
            {!! json_encode($income->receipts) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="receipts[]" value="' + file.file_name + '">')
            }
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
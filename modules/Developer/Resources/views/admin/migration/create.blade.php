@extends('core::layouts.dialog')

@section('content')
<div class="main scrollable">

    {form route="['developer.migration.create', $module]" method="post" class="p-3" autocomplete="off"}

        <div class="container-fluid">

            <div class="form-group">
                <label for="name" class="form-label required">
                    {{trans('developer::migration.name')}}
                </label>
                <div class="form-field">
                    {field type="text" name="name" pattern="^[a-zA-z]+$" required="required"}

                    @if ($errors->has('name'))
                    <span class="form-help text-error">{{ $errors->first('name') }}</span>
                    @else
                    <span class="form-help">{{trans('developer::migration.name.help')}}</span>                     
                    @endif
                </div>                      
            </div>                                            
                       
        </div>

    {/form}
</div>


@endsection

@push('js')
<script type="text/javascript">

    // 对话框设置
    currentDialog.callbacks['ok'] = function(){
        $('form.form').submit();
        return false;
    };
 
</script>
@endpush

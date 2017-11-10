@extends('core::layouts.dialog')

@section('content')
<div class="main scrollable">

    {form route="['developer.command.create', $module]" method="post" class="p-3" autocomplete="off"}

        <div class="container-fluid">

            <div class="form-group row">
                <label for="name" class="col-2 col-form-label required">{{trans('developer::command.name.label')}}</label>
                <div class="col-10">
                    {field type="text" name="name" pattern="^[a-zA-z]+$" required="required"}

                    @if ($errors->has('name'))
                    <span class="form-help text-error">{{ $errors->first('name') }}</span>
                    @else
                    <span class="form-help">{{trans('developer::command.name.help')}}</span>                     
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
    $dialog.callbacks['ok'] = function(){
        $('form.form').submit();
        return false;
    };

    $(function(){

        $('form.form').validate({
       
            submitHandler:function(form){                
                var validator = this;
                $.post($(form).attr('action'), $(form).serialize(), function(msg){

                    // 关闭对话框
                    msg.state && $dialog.close();                    
                    // 弹出消息
                    $.msg(msg);

                },'json').fail(function(jqXHR){
                    return validator.showErrors(jqXHR.responseJSON.errors);
                });
            }            
        });
        
    })  
</script>
@endpush
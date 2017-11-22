@extends('core::layouts.master')

@section('content')

@include('core::config.side')

<div class="main">
    <div class="main-header">
        <div class="main-title mr-auto">
            {{$title}}
        </div>
    </div>
    <div class="main-body scrollable">
        <div class="container-fluid">

            {form model="$config" route="core.config.upload" method="post" id="config" autocomplete="off"}
            <div class="form-title row">{{trans('core::config.upload.base')}}</div>

            <div class="form-group row">
                <label for="types" class="col-2 col-form-label required">{{trans('core::config.upload.types.label')}}</label>
                <div class="col-8">
                    
                    <table class="table table-nowrap form-control">
                        <thead>
                            <tr>
                                <th width="10%">{{trans('core::config.upload.types.type')}}</th>
                                <th>{{trans('core::config.upload.types.extensions')}}</th>
                                <th width="25%">{{trans('core::config.upload.types.maxsize')}}</th>
                                <th width="12%" class="text-center">{{trans('core::config.upload.types.enabled')}}</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($config['upload']['types'] as $type=>$setting)
                            <tr>
                                <td>{{trans('core::file.type.'.$type)}}</td>
                                <td>{field type="text" name="upload[types]['.$type.'][extensions]"}</td>
                                <td>
                                    <div class="input-group">
                                        {field type="number" name="upload[types]['.$type.'][maxsize]" min="0" required="required}
                                        <div class="input-group-addon">MB</div>
                                    </div>
                                </td>
                                <td class="text-center">{field type="toggle" name="upload[types]['.$type.'][enabled]"}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                                       
                    @if ($errors->has('types'))
                    <span class="form-help text-error">{{ $errors->first('types') }}</span>
                    @else
                    <span class="form-help">{{trans('core::config.upload.types.help')}}</span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label for="dir" class="col-2 col-form-label required">{{trans('core::config.upload.dir.label')}}</label>
                <div class="col-8">
                    {field type="radiogroup" name="upload[dir]" options="Module::data('core::upload.dir')"}
                    
                    @if ($errors->has('dir'))
                    <span class="form-help text-error">{{ $errors->first('dir') }}</span>
                    @else
                    <span class="form-help">{{trans('core::config.upload.dir.help')}}</span>
                    @endif
                </div>
            </div>


            <div class="form-title row">{{trans('core::image.resize')}}</div>
            
            <div class="form-group row">
                <label for="resize_enabled" class="col-2 col-form-label">{{trans('core::image.resize.enabled')}}</label>
                <div class="col-8">
                    {field type="toggle" name="image[resize][enabled]"}
                    
                    @if ($errors->has('enabled'))
                    <span class="form-help text-error">{{ $errors->first('enabled') }}</span>
                    @endif
                </div>
            </div>            

            <div class="form-group row">
                <label for="resize_max" class="col-2 col-form-label">{{trans('core::image.resize.max')}}</label>
                <div class="col-5">
                    <div class="input-group">
                        <div class="input-group-addon">{{trans('core::image.resize.width')}}</div>
                        {field type="number" name="image[resize][width]" min="0"}
                        <div class="input-group-addon">{{trans('core::image.resize.height')}}</div>
                        {field type="number" name="image[resize][width]" min="0"}
                        <div class="input-group-addon">px</div>
                    </div>
                    
                    @if ($errors->has('max'))
                    <span class="form-help text-error">{{ $errors->first('max') }}</span>
                    @else
                    <span class="form-help">{{trans('core::image.resize.max.help')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="resize_quality" class="col-2 col-form-label">
                    {{trans('core::image.resize.quality')}}
                </label>
                <div class="col-5">
                    {field type="number" name="image[resize][quality]" min="0" max="100"}
                    
                    @if ($errors->has('quality'))
                    <span class="form-help text-error">{{ $errors->first('quality') }}</span>
                    @else
                    <span class="form-help">{{trans('core::image.resize.quality.help')}}</span>
                    @endif
                </div>
            </div>
            <div class="form-title row">{{trans('core::image.watermark')}}</div>
            
            <div class="form-group row">
                <label for="image_watermark_enabled" class="col-2 col-form-label">
                    {{trans('core::image.watermark.enabled')}}
                </label>
                <div class="col-8">
                    {field type="toggle" name="image[watermark][enabled]"}
                    
                    @if ($errors->has('enabled'))
                    <span class="form-help text-error">{{ $errors->first('enabled') }}</span>
                    @endif
                </div>
            </div>            

            <div class="form-group row">
                <label for="image_watermark_min" class="col-2 col-form-label">{{trans('core::image.watermark.min')}}</label>
                <div class="col-5">
                    <div class="input-group">
                        <div class="input-group-addon">{{trans('core::image.watermark.width')}}</div>
                        {field type="number" name="image[watermark][width]" min="0"}
                        <div class="input-group-addon">{{trans('core::image.watermark.height')}}</div>
                        {field type="number" name="image[watermark][width]" min="0"}
                        <div class="input-group-addon">px</div>
                    </div>
                    
                    @if ($errors->has('min'))
                    <span class="form-help text-error">{{ $errors->first('min') }}</span>
                    @else
                    <span class="form-help">{{trans('core::image.watermark.min.help')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group row watermark-type">
                <label for="image_watermark_type" class="col-2 col-form-label">
                    {{trans('core::image.watermark.type')}}
                </label>
                <div class="col-5">
                    {field type="radiogroup" name="image[watermark][type]" options="Module::data('core::watermark.type')"}
                </div>
            </div>
            <div class="watermark-options d-none" rel="text">
                <div class="form-group row">
                    <label for="image_watermark_font" class="col-2 col-form-label">
                        {{trans('core::image.watermark.font')}}
                    </label>
                    <div class="col-8">
                         {field type="radiocards" name="image[watermark][font][file]" options="Module::data('core::watermark.font.file')"}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image_watermark_font" class="col-2 col-form-label">
                        {{trans('core::image.watermark.font.style')}}
                    </label>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-addon">{{trans('core::image.watermark.font.size')}}</div>
                            {field type="select" name="image[watermark][font][size]" options="Module::data('core::watermark.font.size')"}
                            <div class="input-group-addon">PX</div>                
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-addon">{{trans('core::image.watermark.font.color')}}</div>
                            {field type="text" name="image[watermark][font][color]"}
                        </div>                
                    </div>                
                </div>            
                <div class="form-group row">
                    <label for="image_watermark_text" class="col-2 col-form-label">
                        {{trans('core::image.watermark.text')}}
                    </label>
                    <div class="col-8">
                         {field type="text" name="image[watermark][text]"}
                    </div>
                </div>
            </div>
            <div class="watermark-options d-none" rel="image">
                <div class="form-group row">
                    <label for="image_watermark_image" class="col-2 col-form-label">
                        {{trans('core::image.watermark.image')}}
                    </label>
                    <div class="col-8">
                         {field type="upload_image" name="image[watermark][image]"}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="image_watermark_position" class="col-2 col-form-label">
                    {{trans('core::image.watermark.position')}}
                </label>
                <div class="col-8">
                    <table class="table table-nowrap form-control d-inline-block w-auto">
                        <tbody>
                            <tr>
                            @foreach (Module::data('core::watermark.position') as $value=>$postion)
                                <td class="text-center">
                                    <label class="radio m-0">
                                    {field type="radio" name="image[watermark][position]" value="$value"}
                                    {{$postion}}
                                    </label>
                                </td>
                                @if($loop->iteration%3==0 && $loop->iteration < $loop->count)
                                </tr>
                                <tr>
                                @endif
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <label for="resize_quality" class="col-2 col-form-label">
                    {{trans('core::image.resize.quality')}}
                </label>
                <div class="col-5">
                    {field type="number" name="image[resize][quality]" min="0" max="100"}
                    
                    @if ($errors->has('debug'))
                    <span class="form-help text-error">{{ $errors->first('debug') }}</span>
                    @else
                    <span class="form-help">{{trans('core::image.resize.quality.help')}}</span>
                    @endif
                </div>
            </div>                                                                       
            {/form}
        </div>
    </div><!-- main-body -->
    <div class="main-footer">
        <div class="mr-auto">
            {field type="submit" form="config" value="trans('core::master.save')" class="btn btn-primary"}
        </div>
    </div>
    
</div>

@endsection

@push('js')
<script type="text/javascript">
    $(function(){
        var watermark_type = $('.watermark-type :radio');
        function watermark_type_change() {
            var value = watermark_type.filter(':checked').val();
            $('.watermark-options').addClass('d-none').filter('[rel='+value+']').removeClass('d-none');
        }
        watermark_type_change();
        watermark_type.on('click',function(){
            watermark_type_change();
        });        
    });
    $(function(){
        $('form.form').validate({       
            submitHandler:function(form){                
                var validator = this;

                $('.form-submit').prop('disabled',true);

                $.post($(form).attr('action'), $(form).serialize(), function(msg){
                    
                    $.msg(msg);

                    if ( msg.state && msg.url ) {
                        location.href = msg.url;
                        return true;
                    }

                    $('.form-submit').prop('disabled',false);
                    return false;

                },'json').fail(function(jqXHR){                    
                    $('.form-submit').prop('disabled',false);
                    return validator.showErrors(jqXHR.responseJSON.errors);
                });
            }            
        });
    })
</script>
@endpush

@if($icon)
<div class="input-group input-datetimepicker" id="datetimepicker-{{$name}}">    
    <div class="input-group-prepend"><span class="input-group-text"><i class="{{$icon === true ? 'fa fa-calendar-alt' : $icon}} fa-fw"></i></span></div>
    {{Form::text($name,$value,$attrs)}}
</div>
@else
    {{Form::text($name,$value,$attrs)}}
@endif

@push('js')

    @once('laydate')
    <script type="text/javascript" src="{{Module::asset('core:laydate/laydate.js')}}"></script>
    @endonce
    <script type="text/javascript">
    laydate.render(@json($options));
    </script>
@endpush

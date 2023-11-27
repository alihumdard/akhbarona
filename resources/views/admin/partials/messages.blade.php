@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger alert-notification">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success alert-notification">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success alert-notification">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif
<div class="alert alert-success" id="notice_success" style="display: none;">

</div>
<div class="alert alert-danger" id="notice_error" style="display: none;">
    <ul class="list-unstyled mb-0">
        <li>

        </li>
    </ul>
</div>

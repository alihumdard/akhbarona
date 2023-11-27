    <table class="table table-striped table-borderless dashboard-notice">
        <tbody>
@if($notices->count() > 0)
    @foreach($notices as $notice)
        <tr>
            <td>{{ $notice->title }}</td>
            <td><span>{{ isset($notice->name)?$notice->name:'' }}</span></td>
            <td><span>Last Update {{ date('j\t\h M y',strtotime($notice->updated_at)) }}</span></td>
            <td class="text-center">
                <a href="{{route('notices.view',[$notice])}}" class="btn btn-success">View</a>
                @if($user_id == 0 OR $user_id == $notice->user_id)
                <a href="{{ route('notices.archive', $notice) }}" class="btn btn-dark"
                   title="Archive"
                   data-toggle="tooltip"
                   data-placement="top"
                   data-method="UPDATE"
                   data-confirm-title="@lang('app.please_confirm')"
                   data-confirm-text="{{trans('Are you sure archive notice "'.$notice->title.'"')}}"
                   data-confirm-delete="Yes archive">
                    Archive
                </a>
                @endif

            </td>
        </tr>
    @endforeach
@else
    <tr><td>Don't Have any notices</td></tr>
@endif
        </tbody>
    </table>

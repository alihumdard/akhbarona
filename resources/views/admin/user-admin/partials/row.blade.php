<tr>
    <td style="width: 40px;">
        <img
            class="rounded-circle img-responsive"
            width="40"
            src="{{ $user->present()->avatar }}"
            alt="{{ $user->present()->name }}">
    </td>
    <td class="align-middle">{{ $user->username ?: trans('app.n_a') }}</td>
    <td class="align-middle">{{ $user->first_name . ' ' . $user->last_name }}</td>
    <td class="align-middle">{{ $user->email }}</td>
    <td class="align-middle">{{ isset($roles[$user->role_id])?$roles[$user->role_id]:'DELETED' }}</td>
    <td class="align-middle">
        <span class="badge badge-lg badge-{{ $user->present()->labelClass }}">
            {{ trans("app.{$user->status}") }}
        </span>
    </td>
    <td class="text-center align-middle">
        <a href="{{route('article.index')}}?user_id={{$user->userid}}" title="Browse articles"><i class="fa fa-search"></i></a>

        <a href="{{ route('user-admin.edit', $user->userid) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_user')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('user-admin.delete', $user->userid) }}"
           class="btn btn-icon"
           title="@lang('app.delete_user')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_user')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>

<div class="row column_title">
		<div class="page_title top_navbar_bg">
			<div class="row nowrap ms-3">
            @if(auth()->user()->can('view_user')
                || auth()->user()->can('view_role')
                || auth()->user()->can('view_permission'))
				<div class="dropdown">
                    @can('view_user')
					<a role="button" class="btn navbtncolor" id="useraccount_link" data-target="#" href="{{ url('/users') }}">User Account <span class="caret"></span></a>
                    @endcan
                    @can('view_role')	
					<a role="button" class="btn navbtncolor" id="rolelink" data-target="#" href="{{ url('/roles') }}">Role <span class="caret"></span></a>
                    @endcan
                    @can('view_permission')
					<a role="button" class="btn navbtncolor" id="permission_link" data-target="#" href="{{ url('/permissions') }}">Permission <span class="caret"></span></a>
                    @endcan
				</div>
            @endif
			</div>
		</div>
</div>

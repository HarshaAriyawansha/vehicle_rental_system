<div class="row column_title">
		<div class="page_title top_navbar_bg">
			<div class="row nowrap ms-3">
            @if(auth()->user()->can('view_booking'))
				<div class="dropdown">
                    @can('view_booking')
					<a role="button" class="btn navbtncolor" id="booking_link" data-target="#" href="{{ url('/booking') }}"> Booking <span class="caret"></span></a>
                    @endcan
				</div>
            @endif
			</div>
		</div>
</div>

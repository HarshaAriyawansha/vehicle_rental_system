<div class="row column_title">
		<div class="page_title top_navbar_bg">
			<div class="row nowrap ms-3">
            @if(auth()->user()->can('view_brand')
                || auth()->user()->can('view_model')
                || auth()->user()->can('view_vehicle'))
				<div class="dropdown">
                    @can('view_brand')
					<a role="button" class="btn navbtncolor" id="brand_link" data-target="#" href="{{ url('/brand') }}">Brand <span class="caret"></span></a>
                    @endcan
                    @can('view_model')	
					<a role="button" class="btn navbtncolor" id="model_link" data-target="#" href="{{ url('/model') }}">Model <span class="caret"></span></a>
                    @endcan
                    @can('view_vehicle')
					<a role="button" class="btn navbtncolor" id="vehicle_link" data-target="#" href="{{ url('/vehicle') }}">Vehicle <span class="caret"></span></a>
                    @endcan
				</div>
            @endif
			</div>
		</div>
</div>

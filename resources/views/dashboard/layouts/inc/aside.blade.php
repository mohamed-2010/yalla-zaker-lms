<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
				@if($sidebarItems != null)
					@foreach($sidebarItems as $sidebarItem)
						@if($sidebarItem['level'] == 1) 
							<li class="header">{{ $sidebarItem['title'] }}</li>
						@endif
						@foreach($sidebarItem['childs'] as $childItem)
							@if(isset($childItem['childs']))
								<li class="treeview {{Request::is($childItem['main_url']) ? 'active menu-open' : ''}}">
									<a href="#" class="row">
										<div class="col-sm-1 col-md-1 col-lg-1" style="display: contents;"><i class="{{$childItem['icon']}}"></i></div>
										<span>{{$childItem['title']}}</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										@foreach($childItem['childs'] as $subChildItem)
										<li class="{{Request::is($subChildItem['main_url']) ? 'active' : ''}}"><a href="{{$subChildItem['url']}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{$subChildItem['title']}}</a></li>
										@endforeach
									</ul>
								</li>
							@else
								<li class="{{ Request::is($childItem['main_url']) ? 'active' : '' }}">
									<a href="{{$childItem['url']}}">
										<div class="col-sm-1 col-md-1 col-lg-1" style="display: contents;"><i class="{{$childItem['icon']}}"></i></div>
										<span>{{$childItem['title']}}</span>
										<span class="pull-right-container">
										</span>
									</a>
								</li>
							@endif
						@endforeach
					@endforeach
				@endif
			  </ul>
		  </div>
		</div>
    </section>
	<div class="sidebar-footer">
		<a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Settings"><span class="icon-Settings-2"></span></a>
		<a href="mailbox.html" class="link" data-bs-toggle="tooltip" title="Email"><span class="icon-Mail"></span></a>
		<a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
	</div>
  </aside>
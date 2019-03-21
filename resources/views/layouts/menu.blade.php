
<li><a href="./"><i class="fa fa-tv"></i> Dashboard </a></li>

								@if (Auth::user()->role == 0)
									<li class="{{ Request::is('branches*') ? 'active' : '' }}">
										<a href="{!! route('branches.index') !!}"><i class="fa fa-building-o"></i><span>Branches</span></a>
									</li>
									<!-- <li class="{{ Request::is('brands*') ? 'active' : '' }}">
										<a href="{!! route('brands.index') !!}"><i class="fa fa-edit"></i><span>Brands</span></a>
									</li> -->

									<li class="{{ Request::is('clientTypes*') ? 'active' : '' }}">
										<a href="{!! route('clientTypes.index') !!}"><i class="fa fa-edit"></i><span>Client Types</span></a>
									</li>

									<li class="{{ Request::is('clients*') ? 'active' : '' }}">
										<a href="{!! route('clients.index') !!}"><i class="fa fa-user-o"></i><span>Clients</span></a>
									</li>
								

									<li class="{{ Request::is('models*') ? 'active' : '' }}">
										<a href="{!! route('models.index') !!}"><i class="fa fa-edit"></i><span>Models</span></a>
									</li>
									@endif
                                    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
									<li>
										<a class="{{ Request::is('warehouses*') ? 'active' : '' }}"><i class="fa fa-cubes"></i>WareHouse<span class="fa fa-angle-down pull-right"></span></a>
										<ul class="nav-second-level">
											<!-- <li><a href="{!! route('warehouses.create') !!}">Add Stock</a></li> -->
											<li><a href="{!! route('warehouses.index') !!}">View Currenty Stock</a></li>
											<li><a href="{!! route('warehouseTransctions.index') !!}">Stock Movements</a></li>

										</ul>
									</li>

									<li>
										<a class="{{ Request::is('mainStocks*') ? 'active' : '' }}"><i class="fa fa-cubes"></i>Main Stock<span class="fa fa-angle-down pull-right"></span></a>
										<ul class="nav-second-level">
											<!-- <li><a href="{!! route('mainStocks.create') !!}">Add Stock</a></li> -->
											<li><a href="{!! route('mainStocks.index') !!}">View Currenty Stock</a></li>
											<li><a href="{!! route('mainStockTransctions.index') !!}">Stock Movements</a></li>

										</ul>
									</li>
									@endif
									<li>
										<a href="#"><i class="fa fa-money"></i> Sales 
										<span class="fa fa-angle-down pull-right"></span></a>
										<ul class="nav-second-level">
											<li><a href="#">Add Sale</a></li>
											<li><a href="#">All Sales</a></li>
										</ul>
									</li>
									

									@if (Auth::user()->role == 0)
									<li class="{{ Request::is('employees*') ? 'active' : '' }}">
									<a href="{!! route('employees.index') !!}"><i class="fa fa-edit"></i><span>Employees</span></a>
									</li>
									@endif
								
									@if (Auth::user()->role == 0 || Auth::user()->role == 1)
									<li>
										<a href="#"><i class="fa fa-file-text-o"></i> Reports 
										<span class="fa fa-angle-down pull-right"></span></a>
										<ul class="nav-second-level">
											<li><a href="#">General Report</a></li>
											<li><a href="#">Sales Report</a></li>
											<li><a href="#">Transfer Report</a></li>
										</ul>
                                    </li>
									@endif




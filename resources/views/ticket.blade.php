@extends('layouts.main_landing')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('styles/product_styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('styles/product_responsive.css')}}">

	<style media="screen">
		.manage-event .btn:hover{
			cursor: pointer;
		}
	</style>
@endsection

@section('categories')
	<div class="cat_menu_container">
		<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
			<div class="cat_burger"><span></span><span></span><span></span></div>
			<div class="cat_menu_text">categories</div>
		</div>
		<ul class="cat_menu">
			<li><a href="#">All Categories <i class="fas fa-chevron-right ml-auto"></i></a></li>
			<li><a href="#">Cinemas <i class="fas fa-chevron-right"></i></a></li>
			<li><a href="#">Events<i class="fas fa-chevron-right"></i></a></li>
			<li><a href="#">Sport<i class="fas fa-chevron-right"></i></a></li>
			<li><a href="#">Others<i class="fas fa-chevron-right"></i></a></li>
		</ul>
	</div>
@endsection

@section('content')


	<div class="single_product">
		{{-- show message if it's user's event --}}
		@if (Auth::user() && $event->owner == Auth::user()->id)
		<div class="container">
				<div class="alert alert-info">
					This event is posted by you.
				</div>
		</div>
		@endif

		<div class="container">
			{{-- Admin can approve/ decline event if it is still pending --}}
			<div class="card mb-3 manage-event">
				@if (Auth::user() && Auth::user()->role == 1 && $event->approved == 0)
					<div class="card-body">
						<p>Manage event status: </p>
						<button type="button" class="btn btn-success" name="button">Approve</button>
						<button type="button" class="btn btn-danger" name="button">Decline</button>
					</div>
				@endif
			</div>

			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						@foreach ($event->pictures as $ep)
							<li data-image="{{asset('storage') . "/" . $ep->location}}"><img src="{{asset('storage') . "/" . $ep->location}}" alt=""></li>
						@endforeach
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{asset('storage') . "/" . $event->pictures[0]->location}}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{$event->type}}
							@if ($event->type == "Sport")
								| {{$event->sport_type}}
							@endif
						</div>
						<div class="product_name">{{$event->name}}</div>
						<div class="product_text"><p>
							{{$event->description}}
						</p>
						<p>Location: {{$event->city}}</p>
						<p>
							<strong>Posted by: {{$posted_by->name}}</strong>
						</p>
					</div>
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">
									<div class="form-group">
										<label for="">Quantity</label>
										<input type="number" class="form-control" name="" value="1" id="ticket_quantity" min="1" max="{{$event->quota}}" step="1">
									</div>

								</div>

								<div class="product_price">
									Rp {{number_format($event->price,2,',','.')}}</div>
								<div class="button_container">
									<button type="button" class="button cart_button">Order Now</button>

								</div>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Events you might like</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_1.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Beoplay H7</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_2.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_3.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225</div>
										<div class="viewed_name"><a href="#">Samsung J730F...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_4.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_5.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('images/view_6.jpg')}}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$375</div>
										<div class="viewed_name"><a href="#">Speedlink...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
	<script src="{{asset('js/product_custom.js')}}"></script>
	<script type="text/javascript">
		$(".cart_button").click(function(){
			if (!'{{Auth::user()}}') {
				alert("Please login first!");
			}
			const quantity = $("#ticket_quantity").val();
			// const
			$.ajax({
				url: '{{url('order/events')}}',
				data: {}
			})


		});
	</script>
@endsection
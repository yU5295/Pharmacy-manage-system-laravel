@extends('layouts.app')

@push('page-css')
	
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Sales</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Sales</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="#add_sales" data-toggle="modal" class="btn btn-primary float-right mt-2">Add Sales</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
	
		<!-- Recent Sales -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Medicine Name</th>
								<th>Total Price</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sales as $sale)
							<tr>
								<td>{{$sale->product->purchase->name}}</td>
								<td>{{AppSettings::get('app_currency', '$')}} {{($sale->total_price)}}</td>
								<td>{{date_format(date_create($sale->created_at),"d M, Y")}}</td>
								<td>
									<div class="actions">
										<a class="btn btn-sm bg-success-light" href="javascript:void(0);">
											<i class="fe fe-pencil"></i> Edit
										</a>
										<a data-id="{{$sale->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
											<i class="fe fe-trash"></i> Delete
										</a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Recent sales -->
		
	</div>
</div>
<!-- Delete Modal -->
<x-modals.delete :route="'sales'" :title="'Product Sale'" />
<!-- /Delete Modal -->
<!-- Add Modal -->
<div class="modal fade" id="add_sales" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Sell Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('sales')}}">
					@csrf
					<div class="row form-row">
						<div class="col-12">
							<div class="form-group">
								<label>Product <span class="text-danger">*</span></label>
								<select class="form-control select" name="product"> 
									@foreach ($products as $product)
										<option value="{{$product->id}}">{{$product->purchase->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<input type="hidden" name="">
						<div class="col-12">
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" value="1" class="form-control" name="quantity">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /ADD Modal -->
@endsection


@push('page-js')
	
@endpush

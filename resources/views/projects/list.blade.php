@extends('layouts.main')

@section('title', 'Projects')

@section('content')

	<div class="row">
    	<div class="col-lg-12">
        	<h1 class="page-header">Projects</h1>
        </div>
  	</div>
    <p>List of {{ $status }} projects in <strong>Egypt</strong> by <a href="http://betterplace.org/">betterplace</a>.</p>

    <div class="filtersort">
	    <div class="filters" style="">
		    <div class="btn btn-default {{ activeFilter('all') }}" data-status="all">
				<a href="#"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> All</a>
			</div>

			<div class="btn btn-default {{ activeFilter('active') }}" data-status="active">
				<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Active
			</div>

			<div class="btn btn-default {{ activeFilter('completed') }}" data-status="completed">
				<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Completed
			</div>
		</div>

		<div class="sort_order">
			<div class="form-group">
			  	<select class="form-control" id="sort_order">
				    <option value="ASC" {{ isSelected($order_by, 'ASC') }}>ASC</option>
				    <option value="DESC" {{ isSelected($order_by, 'DESC') }}>DESC</option>
			  	</select>
			</div>
		</div>

		<div class="sort_key">
			<div class="form-group">
			  	<select class="form-control" id="sort_key">
				    <option value="title" {{ isSelected($field, 'title') }}>Title</option>
				    <option value="donors_count" {{ isSelected($field, 'donors_count') }}>Donors</option>
				    <option value="progress_percentage" {{ isSelected($field, 'progress_percentage') }}>Funding</option>
				    <option value="positive_opinions_count" {{ isSelected($field, 'positive_opinions_count') }}>Positive Opinion</option>
			  	</select>
			</div>
		</div>
	</div>

    @if (count($projects) > 0)
	    @foreach ($projects as $project)
		    <div class="panel panel-default">
		 		<div class="panel-heading">
				    <h3 class="panel-title">{{ $project->title }}</h3>
				</div>
		  		<div class="panel-body">
			    	{{ getDescription($project->description) }}
			  	</div>
			  	<div class="panel-footer">
			  		<div class="progress">
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
					  		aria-valuenow="{{ $project->progress_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $project->progress_percentage }}%">
					    	{{ $project->progress_percentage }}% funded
					  	</div>
					</div>

					<div class="btn btn-default">
					  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> {{ $project->city }}
					</div>

					<div class="btn btn-default">
					  <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> {{ $project->positive_opinions_count }}
					</div>

					<div class="btn btn-default">
					  <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> {{ $project->negative_opinions_count }}
					</div>

					<div class="btn btn-default">
					  <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> {{ $project->donor_count }} donors
					</div>

					<div class="btn btn-default">
					  <span class="glyphicon glyphicon-euro" aria-hidden="true"></span> {{ getAmount($project->open_amount_in_cents) }} needed
					</div>

					<div class="btn btn-default" id="project_{{ $project->external_id }}" onclick="viewProject({{ $project->external_id }});" 
						data-location="https://www.betterplace.org/en/projects/{{ $project->external_id }}">
					  <span class="glyphicon glyphicon-link" aria-hidden="true"></span> View on Betterplace
					</div>
					
			  	</div>
			</div>
		@endforeach
	@else
    	<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <strong>Oops!</strong> Looks like there are no projects available.
        </div>
	@endif

@stop
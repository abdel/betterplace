@extends('layouts.main')

@section('title', 'Projects')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Overview of Egypt</h1>
        </div>
    </div>

    @if ($totalProjects > 0)
        <div class="progress">
    		<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
    			aria-valuenow="{{ $totalPercentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $totalPercentage }}%">
    			{{ $totalPercentage }}% funded
    		</div>
    	</div>
                
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ $totalProjects }}</h3>
                            <strong>Total Projects</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ $totalActiveProjects }}</h3>
                            <strong>Active Projects</strong>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ $totalCompletedProjects }}</h3>
                            <strong>Completed Projects</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>€{{ getAmount($totalFundsNeeded) }}</h3>
                            <strong>Amount Currently Needed<strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ number_format($totalDonors) }}</h3>
                            <strong>Donors<strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>€{{ getAmount($totalDonations) }}</h3>
                            <strong>Amount Raised<strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ number_format($totalPositiveOpinions) }}</h3>
                            <strong>Positive Opinions<strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3>{{ number_format($totalNegativeOpinions) }}</h3>
                            <strong>Negative Opinions<strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
    		 		<div class="panel-heading">
    				    <h3 class="panel-title"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Day/Hour Heatmap for Donations</h3>
    				</div>
    		  		<div class="panel-body text-center">
    		  			<div id="heatMap"></div>
    		  		</div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <strong>Oops!</strong> Looks like there are no projects available.
        </div>
    @endif
@stop
<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Opinion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {

    public function getIndex()
    {
        $totalProjects = DB::table('projects')->count();

        if ($totalProjects > 0 )
        {
            $totalActiveProjects = DB::table('projects')->whereNull('completed_at')->count();
            $totalCompletedProjects = DB::table('projects')->whereNotNull('completed_at')->count();
            $totalPercentage = round($totalActiveProjects / $totalProjects * 100);
            $totalFundsNeeded = DB::table('projects')->sum('open_amount_in_cents');
            $totalDonors = DB::table('projects')->sum('donor_count');
            $totalPositiveOpinions = DB::table('projects')->sum('positive_opinions_count');
            $totalNegativeOpinions = DB::table('projects')->sum('negative_opinions_count');
            $totalDonations = DB::table('opinions')->sum('donated_amount_in_cents');

            return view('projects.index', [
                'totalProjects' => $totalProjects,
                'totalActiveProjects' => $totalActiveProjects,
                'totalCompletedProjects' => $totalCompletedProjects,
                'totalPercentage' => $totalPercentage,
                'totalFundsNeeded' => $totalFundsNeeded,
                'totalDonors' => $totalDonors,
                'totalDonations' => $totalDonations,
                'totalPositiveOpinions' => $totalPositiveOpinions,
                'totalNegativeOpinions' => $totalNegativeOpinions
            ]);
        }
        else
        {
            return view('projects.index', ['totalProjects' => $totalProjects]);
        }
        
    }

    public function getList(Request $request)
    {
        // Get all sort/fitler params
        $field = $request->input('field') ?: 'progress_percentage';
        $status = $request->input('status') ?: 'all';
        $order_by = $request->input('order_by') ?: 'ASC';

        $projects = DB::table('projects');

        // Filter project by status
        if ($status == 'completed')
        {
            $projects = $projects->whereNotNull('completed_at');
        } 
        elseif ($status == 'active')
        {
            $projects = $projects->whereNull('completed_at');
        }

        // Sort projects accordingly
        $projects = $projects->orderBy($field, $order_by);

        $projects = $projects->get();

        return view('projects.list', [
            'projects' => $projects, 
            'field' => $field,
            'status' => $status,
            'order_by' => $order_by
        ]);
    }

    public function getUpdateAll()
    {
        // Fetch all projects in Egypt
        $ch = curl_init();
        $projectsUrl = "https://api.betterplace.org/en/api_v4/projects.json?around=Egypt&scope=location&per_page=100";

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,  $projectsUrl);
        
        $projects = json_decode(curl_exec($ch), true);
        curl_close($ch);

        foreach ($projects['data'] as $project)
        {
            if ($project['country'] == 'Egypt') 
            {
                $projectData = array(
                    'external_id' => $project['id'],
                    'city' => $project['city'],
                    'country' => $project['country'],
                    'title' => $project['title'],
                    'description' => $project['description'],
                    'tax_deductible' => $project['tax_deductible'],
                    'donations_prohibited' => $project['donations_prohibited'],
                    'completed_at' => $project['completed_at'],
                    'open_amount_in_cents' => $project['open_amount_in_cents'],
                    'positive_opinions_count' => $project['positive_opinions_count'],
                    'negative_opinions_count' => $project['negative_opinions_count'],
                    'donor_count' => $project['donor_count'],
                    'progress_percentage' => $project['progress_percentage'],
                    'incomplete_need_count' => $project['incomplete_need_count'],
                    'completed_need_count' => $project['completed_need_count'],
                );

                // Insert new or update existing project
                $newProject = Project::firstOrNew(array('external_id' => $project['id']));
                $newProject->fill($projectData);
                $newProject->save();
            }
        }

        // Fetch all opinions for the given project
        $mh = curl_multi_init();
        $curl_arr = array();
        $projects = Project::all();
        $totalProjects = $projects->count();

        for($i = 0; $i < $totalProjects; $i++)
        {   
            $opinionsUrl = "https://api.betterplace.org/de/api_v4/projects/".$projects[$i]['external_id']."/opinions.json?per_page=".$projects[$i]['donor_count'];

            // Executing requests in parallel
            $curl_arr[$i] = curl_init($opinionsUrl);
            curl_setopt($curl_arr[$i], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mh, $curl_arr[$i]);
        }

        do {
            curl_multi_exec($mh, $running);
        } while($running > 0);

        for($i = 0; $i < $totalProjects; $i++)
        {
            $opinions = json_decode(curl_multi_getcontent($curl_arr[$i]), true);

            foreach ($opinions['data'] as $opinion)
            {
                // Excluding opinions witothout a donation
                if (isset($opinion['donated_amount_in_cents'])) 
                {
                    $opinionData = array(
                        'external_id' => $opinion['id'],
                        'project_id' => $project['id'],
                        'donated_amount_in_cents' => $opinion['donated_amount_in_cents'],
                        'score' => $opinion['score'],
                        'author' => $opinion['author']['name'],
                        'message' => $opinion['message'],
                        'donated_at' => $opinion['created_at']
                    );

                    // Insert new or update existing opinion
                    $newOpinion = Opinion::firstOrNew(array('external_id' => $opinion['id']));
                    $newOpinion->fill($opinionData);
                    $newOpinion->save();
                }
            }
        }

        curl_multi_close($mh);

        return view('projects.update');
    }

    public function getDonationsTime() {
        $donations = DB::table('opinions')->lists('donated_amount_in_cents', 'donated_at');
        $output = [];
        $i = 0;

        // Prepare output for D3.js
        foreach ($donations as $time => $donation) {
            $date = new \DateTime($time);
            $output[$i]['day'] = $date->format('N');
            $output[$i]['hour'] = $date->format('h');
            $output[$i]['value'] = $donation / 100; // Cents -> Euros
            $i++;
        }

        return response()->json($output);
    }
}
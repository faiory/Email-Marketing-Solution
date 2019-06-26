<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Subgroup;
use App\Newsletter;
class ScheduleController extends Controller
{
    //
    public function index()
    {
        $schedules = Schedule::paginate(5);
        $subgroups = Subgroup::All();
        $newsletters = Newsletter::All();
        return view('schedule', ['schedules' => $schedules, 'subgroups' => $subgroups, 'newsletters' => $newsletters]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:schedules|max:30',
            'subgroup_id' => 'required',
            'newsletter_id' => 'required',
            'execution_time' => 'required',
        ]);

        if(!$validatedData){
            return redirect('schedule');
        } else {
            $schedule = new Schedule();
            $schedule->name = $request->name;
            $schedule->subgroup_id = $request->subgroup_id;
            $schedule->execution_time = $request->execution_time;
            $schedule->newsletter_id = $request->newsletter_id;
            $schedule->executed = "No";
            $schedule->save();
            return redirect('schedule');
        }
        return redirect('schedule');
    }
    
    
    public function modify(Request $request){
        // Validate the request...
        $validatedData = $request->validate([
            'name' => 'required|unique:schedules|max:30',
            'id' => 'required'
        ]);
        if(!$validatedData){
            return redirect('schedule');
        } else {
            if(Schedule::find($request->id)) {
                $schedule = Schedule::find($request->id);
                $schedule->name = $request->name;
                $schedule->save();
            } 
            return redirect('schedule');
        }
    }

    public function delete(Request $request){
        if (Schedule::find($request->id)) {
            Schedule::destroy($request->id);
            return redirect('schedule');
        } else {
            return redirect('schedule');
        }        
    }
}

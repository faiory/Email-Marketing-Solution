<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Schedule;

class NewsletterController extends Controller
{

    public function index()
    {
        $newsletters = Newsletter::paginate(5);
        return view('newsletters', ['newsletters' => $newsletters]);
    }
    

    //CREATE NEW USER
    public function store(Request $request)
    {
        // Validate the request...
        $validatedData = $request->validate([
            'name' => 'required|unique:newsletters|max:30',
            'content' => 'required'
        ]);

        if(!$validatedData){
            return redirect('newsletters');
        } else {
            $newsletter = new Newsletter();
            $newsletter->name = $request->name;
            $newsletter->content = $request->content;
            $newsletter->save();
            return redirect('newsletters');
        }
    }
    public function delete(Request $request){
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        if(!$validatedData){
            return redirect('newsletters');
        } else {
            foreach (Schedule::where('newsletter_id', $request->id)->get() as $schedule) {
                $schedule->delete();
            }
            Newsletter::find($request->id)->delete(); 
            return redirect('newsletters');
        }

    }

    public function modify(Request $request){

        if ($newsletter = Newsletter::find($request->id)) {
            if ($newsletter->name == $request->name) {
                $validatedData = $request->validate([
                    'id' => 'required',
                    'content' => 'required'
                ]);
            } else {
                $validatedData = $request->validate([
                    'id' => 'required',
                    'name' => 'required|unique:newsletters|max:30',
                    'content' => 'required'
                ]);
            }
            if(!$validatedData){
                return redirect('newsletters');
            } else {
                $newsletter->name = $request->name;
                $newsletter->content = $request->content;
                $newsletter->save();
                return redirect('newsletters');
            }
            
        } else {
            $this->store($request);
        }
    }
}

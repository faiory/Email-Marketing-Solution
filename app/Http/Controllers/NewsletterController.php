<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;

class NewsletterController extends Controller
{

    public function index()
    {
        $newsletters = Newsletter::paginate(5);
        return view('newsletters', ['newsletters' => $newsletters]);
    }
    
    // public function getContent($id)
    // {
    //     $newsletters = Newsletter::paginate(5);
    //     $content = Newsletter::find($id)->content;
    //     return redirect('newsletters');
    // }

    //CREATE NEW USER
    public function store(Request $request)
    {
        // Validate the request...
        $validatedData = $request->validate([
            'name' => 'required|unique:newsletters|max:30',
            'sourceCode' => 'required'
        ]);

        if(!$validatedData){
            return redirect('newsletters');
        } else {
            $newsletter = new Newsletter();
            $newsletter->name = $request->name;
            $newsletter->content = $request->sourceCode;
            $newsletter->save();
            return redirect('newsletters');
        }
    }
    public function delete($id){
        Newsletter::find($id)->delete(); 
    }
}

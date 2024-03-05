<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(5);
    
        // foreach ($annonces as $annonce) {
        //     $applications = JobDatingApplication::where('job_dating_offer_id', $annonce->id)->get();
        //     $users = User::whereIn('id', $applications->pluck('user_id'))->get(['id', 'name']);
        //     $annonce->postulants = $users;
        // }
    
        return view('admin.events.index', compact('events'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = Category::all();
        
        return view('admin.events.create', compact('categorys'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = Event::create($request->validated());

    
        return redirect()->route('events.index')
                        ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $annonce)
    {
        return view('admin.events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Récupérer l'annonce spécifique par son identifiant
        $event = Event::findOrFail($id); 
    
        // Récupérer toutes les entreprises
        $categorys = Category::all(); 
    
    
        // Retourner la vue d'édition avec l'annonce, les entreprises et les compétences
        return view('admin.events.edit', compact('event', 'categorys'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {

        
        $event->update($request->validated());
        return redirect()->route('events.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
      
        $event->delete();
         
        return redirect()->route('events.index')
                        ->with('success','Company deleted successfully');
    }

    public function showDashboard()
    {
        $events = Event::all(); 
        return view('events.index', compact('events'));
    }

    // public function showWelcome()
    // {
    //     $annonces = Annonce::latest()->paginate(5); 
    //     return view('welcome', compact('annonces'));
    // }

    
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
  /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
    
        // Vérifier si l'utilisateur a le rôle d'administrateur
        if ($user->hasRole('admin')) {
            // Si l'utilisateur est administrateur, récupérer tous les événements sans pagination
            $events = Event::with('reservations')->get();
        } else {
            // Sinon, récupérer les événements associés à l'utilisateur authentifié avec pagination
            $events = $user->events()->with('reservations')->paginate(5);
        }
    
        return view('admin.events.index', compact('events'));
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
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events_images', 'public');
    
            $validatedData['image'] = $imagePath;
        }
        
        $validatedData['validation'] = $request->input('validation');
        
        $event = Event::create($validatedData);
    
        return redirect()->route('events.index')
                        ->with('success', 'Événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
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
       
        $validatedData = $request->validated();
        
    
        if ($request->hasFile('image')) {
           
            $imagePath = $request->file('image')->store('events_images', 'public');
    
            $validatedData['image'] = $imagePath;
            
           
            $event->image = $imagePath;
        }
    
    
        $event->update($validatedData);
    
        
        return redirect()->route('events.index')
                         ->with('success', 'Event updated successfully');
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
        $reservations = Reservation::all();
        return view('events.index', compact('events', 'reservations'));
    }

    public function showWelcome()
    {
        $events = Event::where('accepted', true)->latest()->paginate(2); 
        $categorys = Category::all();
        return view('welcome', compact('events', 'categorys'));
    }

    public function accept(Event $event)
{
    $event->update(['accepted' => true]);

    return redirect()->back()->with('success', 'Event accepted successfully.');
}


public function search(Request $request)
{
    $query = $request->input('query');
    $events = Event::where('titre', 'like', '%' . $query . '%')->get();
    return response()->json($events);
}

public function filterByCategory(Request $request)
{
    $categoryId = $request->category_id;
    $events = Event::with('category')->where('category_id', $categoryId)->where('accepted', true)->get();
    if ($events->count() > 0) 
        return response()->json($events);
    return response()->json([]);
}


    
}
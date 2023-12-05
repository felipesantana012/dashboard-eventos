<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//importando o Event model para conseguir acessalo
use App\Models\Event;

//importando usuario 
use App\Models\User;

class EventController extends Controller
{
    public function index(){

        $search = request('search');
        if($search){
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        }else{
              //chamando tudo do meu banco de Eventos
              $events = Event::all();
        }

      
    
        //passando as para a view coseguir acessalas
        return view('testando', ['events' => $events, 'search' => $search]);
    }


    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        

        //uplouad image
        if($request->hasFile('image') && $request->file('image') -> isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            //add path no banco
            $imageName = md5($requestImage->getClientOriginalName(). strtotime("now")). "." . $extension;

            //add imagem na pasta.
            $request->image->move(public_path('img/events'), $imageName);
            $event->image = $imageName;

        }

        //pegando o usuario logado
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/') ->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->eventsAsParticipant->toArray();
            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events'=>$events, 'eventsAsParticipant'=>$eventsAsParticipant]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso');
    }

    public function edit($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if($user->id != $event->user->id){
         return view('/dashboard');
        }


        return view('events.edit',['event' =>$event]);
    }

    public function update(Request $request){
        $data = $request->all();

            //uplouad image
            if($request->hasFile('image') && $request->file('image') -> isValid()){

                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                //add path no banco
                $imageName = md5($requestImage->getClientOriginalName(). strtotime("now")). "." . $extension;
    
                //add imagem na pasta.
                $request->image->move(public_path('img/events'), $imageName);
                $data['image'] = $imageName;
    
            }

        Event::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso');
    }

    public function joinEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'sua presença foi confirmada no evento' . $event->title);
    }

    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'voce saiu com sucesso evento');
    }

}

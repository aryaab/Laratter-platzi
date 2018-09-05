<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
	public function create(CreateMessageRequest $request)
    {
    	$rules = [
    		'message' => 'required|max:14'
    	];

    	$messages = [
    		'message.required' => 'Este mensaje es requerido',
    		'message.max' => 'El mensaje no debe extender los 14 carácteres.'
    	];

    	// $this->validate($request, $rules, $messages);
    	// $this->validate($request);

        // return $request->all();
        $user = $request->user();

        $image = $request->file('image');

        $message = Message::create([
            'user_id' => $user->id,
        	'content' => $request->input('message'),
        	'image' => $image->store('message', 'public'),
        ]);

        return redirect('/messages/'.$message->id);
    }

    public function show(Message $message) 
    {

    	$message = Message::find($message->id);

    	return view('messages.show', ['message' => $message]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // $message = Message::with('user')->where('content', 'LIKE', "%$query%")->get();

        $message = Message::search($query)->paginate(10);
        $message->load('user');
        //with para cuando se arma una query
        //load, para cuando se tiene una query ejecutada.

        // return $message;

        return view('messages.index', [
            'messages' => $message,
        ]);
    }

    public function responses(Message $message)
    {
        return $message->responses;
    }
}

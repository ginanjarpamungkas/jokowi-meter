<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MailController extends Controller{
    public function sendemail(Request $request){
        $data = array(
            'name' => $request->nama,
            'email'=> $request->email,
            'pesan'=> $request->pesan,
        );
        \Mail::send('email.promise', compact('data'), function($message) use ($data){
            $message->from($data['email']);
            $message->to('cekfakta@tempo.co.id');
            $message->subject('Janji Jokowi Meter');
        });
    
        return back()->with('success','Janji yang kamu laporkan sudah terkirim.');
    }
}

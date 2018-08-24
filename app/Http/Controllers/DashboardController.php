<?php

namespace App\Http\Controllers;

use App\Messages;
use App\Records;
use App\Sites;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function create() {
        return view('dashboard/create');
    }
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|string|min:4|max:50',
                'path' => 'required|string|min:4|max:50'
            ]);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
            $request->session()->flash('errors', $errors);
            return back();
        }

        $site = new Sites;
        $site->name = $request->name;
        $site->path = $request->path;
        $site->user_id = Auth::id();
        $site->save();
        return response()->json($site);

    }

    public function show($site_id) {
        $site = Sites::where('sites_id', $site_id)->where('user_id', Auth::id())->firstOrFail();
        $records = Records::where('sites_id', $site_id)->get();
        return view('dashboard/dashboard', ['site' => $site, 'records' => $records]);
    }

    public function messages($site_id) {
        $site = Sites::where('sites_id', $site_id)->where('user_id', Auth::id())->firstOrFail();
        $messages = Messages::where('site_id', $site_id)->get();

        return view('dashboard/messages', ['messages' => $messages, 'site_id' => $site_id]);
    }

    public function storeMessages(Request $request, $site_id) {
        try {
            $this->validate($request, [
               'message' => 'required|min:6|max:255'
            ]);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
            $request->session()->flash('errors', $errors);
            return back();
        }
        $site = Sites::where('sites_id', $site_id)->where('user_id', Auth::id())->firstOrFail();

        $message = new Messages;
        $message->site_id = $site_id;
        $message->message = $request->message;
        $message->save();

        return back();

    }

    public function deleteMessages($message_id) {
        $message = Messages::find($message_id);
        $site = Sites::where('sites_id', $message->site_id)->where('user_id', Auth::id())->firstOrFail();
        $message->delete();
        return back();
    }

    public function welcome(Request $request, $site_path) {
//        dd($request);
        try {
            $request->validate([
                'name' => ['required', 'string', 'min:4','max:50'],
                'phone_number' => ['required','regex:/^\d{10}$|^\d{11}$/'],
                'email' => ['required','email'],
                'message' => ['required','string','min:6','max:255']
            ]);
        } catch (\Exception $e) {
            dd($e);
            $errors[] = $e->getMessage();
            $request->session()->flash('errors', $errors);
            // fix back
            return back();
        }
        $site_id = Sites::where('path', $site_path)->first()->sites_id;

        $records = new Records;
        $records->sites_id = $site_id;
        $records->name = $request->name;
        $records->phone_number = $request->phone_number;
        $records->email = $request->email;
        $records->message = $request->message;
        $records->save();

        return redirect()->away('https://wa.me/'.'6'.$request->phone_number.'/'.$request->message);
    }

    public function welcomeGet($site_path) {
        $site_id = Sites::where('path', $site_path)->first()->sites_id;
        $messages = Messages::where('site_id', $site_id)->get();
        return view('interface', ['site' => $site_path, 'messages' => $messages]);
    }
}

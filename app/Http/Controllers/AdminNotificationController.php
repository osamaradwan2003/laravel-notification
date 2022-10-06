<?php

namespace App\Http\Controllers;

use App\Events\DesktopEvent;
use App\Models\Notifications;
use App\Models\NotifySettings;
use App\Models\User;
use App\Notifications\Mail;
use App\Notifications\Slack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminNotificationController extends  Controller
{

    private array  $data;
    private User $user;

    public function __construct(array $data=[])
    {
        $this->data = $data;
        $this->user = User::all()->where('is_admin' ,'=', true)[0];
    }

    public function index()
    {
        if(auth()->id() != $this->user->id){
            return redirect(route('home'));
        }
        $channels = NotifySettings::all();
        return view('notificationSetting', ['channels'=>$channels]);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {

        foreach ($request->request as $id => $val){

            if($id == '_token'){
                continue;
            }

            $nt = NotifySettings::find($id);
            $nt->is_active = $val;
            $nt->save();
        }

        return redirect()->back()->with('status', 'Success');

    }

    public function DispatchNotification()
    {
        $channels = NotifySettings::all()->where('is_active', '=', '1');
        $notify = $this->notificationArray();
          foreach ($channels as $channel){
            call_user_func_array($notify["$channel->channel"], [$this->data]);
            $noti = new Notifications();
            $noti->type = $channel->channel;
            $noti->notifiable_type = ' ';
            $noti->notifiable_id = $channel->id;
            $noti->data = json_encode( $this->data);
            $noti->save();
          }

    }

    /**
     *
     * @return string[]
     */

    private function notificationArray(): array
    {
        return [
            'slack' => function($d){
                Notification::send($this->user, new Slack($d));
            },
            'mail' => function($d){
                Notification::send($this->user, new Mail($d));
            },
            'desktop' => function($d){
                event(new DesktopEvent($d, $this->user->id));
            }
        ];
    }


}

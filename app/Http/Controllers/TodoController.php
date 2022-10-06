<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    use Notifiable;
    protected string $email;

    public function __construct(Request $request)
    {
//        $this->middleware('auth');

    }

    public function index()
   {
       $todos = Todo::all();
       return view('todos.index', compact('todos'));
   }



   public function create()
   {
       return view('todos.create');
   }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): string
    {
        $this->email = User::find(Auth()->id())->email;
        $this->validate($request, [
           'name'=>'required| min:6|max:40',
           'descriptions'=> 'required'

        ]);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->descriptions = $request->descriptions;
        $todo->compleated = false;

        $todo->save();

        $data = [
            'slackMessage'=>'Task' . $todo->name . ' created Successfully',
            'mailMessage' => 'Task' . $todo->name . ' created Successfully',
            'desktopMessage' => ['msg'=> 'Task' . $todo->name . ' created Successfully'],
        ];

        $not = new AdminNotificationController($data);
        $not->DispatchNotification();
        return redirect(route('home'))->with('status', 'Item Create Successfully');

   }





   public function view($id)
   {
       $todos = Todo::find($id);
       return view('todos.view', compact('todos'));
   }



   public function edit($id)
   {
       $todo = Todo::find($id);
       return view('todos.edit', compact('todo'));
   }


    //update data in edit pages By Update Modal No other Page
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
            'descriptions' => 'required',
        ]);

        $todos = Todo::find($id);
        $todos->name = $request->name;
        $todos->descriptions = $request->descriptions;
        $todos->compleated =false;
        $todos->save();

        $data = [
            'slackMessage'=>'Task' . $todos->name . ' Updated Successfully',
            'mailMessage' => 'Task' . $todos->name . ' Updated Successfully',
            'desktopMessage' => ['msg'=> 'Task' . $todos->name . ' Updated Successfully'],
        ];

        $not = new AdminNotificationController($data);
        $not->DispatchNotification();

        return redirect(route('home'))->with('status', 'data updated!');
    }





   public function delete($id)
   {
    $todos = Todo::find($id);
    $todos->delete();
   $data = [
       'slackMessage'=>'Task' . $todos->name . ' Deleted Successfully',
       'mailMessage' => 'Task' . $todos->name . ' Deleted Successfully',
       'desktopMessage' => ['msg'=> 'Task' . $todos->name . ' Deleted Successfully'],
   ];

   $not = new AdminNotificationController($data);
   $not->DispatchNotification();
    return redirect('/');

   }





  // compleated button
  public function compleated($id)
  {
   $todos= Todo::find($id);
   $todos->compleated=true;
   $todos->save();
      $data = [
          'slackMessage'=>'Task' . $todos->name . ' Compleated',
          'mailMessage' => 'Task' . $todos->name . ' Compleated',
          'desktopMessage' => ['msg'=> 'Task' . $todos->name . ' Compleated'],
      ];

      $not = new AdminNotificationController($data);
      $not->DispatchNotification();
   return redirect('/');
  }


}

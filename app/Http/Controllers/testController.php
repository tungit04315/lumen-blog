<?php

namespace App\Http\Controllers;

use App\Http\Helper\ResponseBuilder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function index()
    {
        echo "Hello Controller Test";
    }

    // public function list()
    // {
    //     return User::all();
    // }

    public function list()
    {
        $data = User::all();
        $status = true;
        $info = "Data is listed seccuessfully";
        return ResponseBuilder::results($status, $info, $data);
    }

    public function createOrder(Request $request)
    {
        $order = new Order();
        $order->order_id = $request->input('order_id');
        $order->order_number = $request->input('order_number');
        $order->user_id = $request->input('user_id');
        echo $order->save();
    }

    public function createUser(Request $request)
    {
        $user = new User();
        $user->id = $request->input('id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        echo $user->save();
    }

    public function updateUser(Request $request, $id)
    {
        //$id = $request->input('id');
        echo $id;
        $user = User::find($id);
        echo $user;

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        // $user->id = $id;

        $user->save();
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 400);
        }

        $user->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    public function findByUser(Request $request)
    {
        $id = $request->input('id');
        $user = \App\User::Where('id', $id);
        $results = $user->get();
        echo $results;
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->save();

        $users = User::all();
        $message = [
            'type' => 'Create task',
            'task' => $task->name,
            'content' => 'has been created!',
        ];
        SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));

        return redirect()->back();
    }

}

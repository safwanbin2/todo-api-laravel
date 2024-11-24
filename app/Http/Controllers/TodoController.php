<?php

namespace App\Http\Controllers;

use App\Jobs\TodoJob;
use App\Mail\TodoMail;
use App\Models\TodoModel;
use Illuminate\Support\Facades\Mail;

class TodoController extends Controller
{
    // viewing all the todos
    public function index()
    {
        $todos = TodoModel::all();
        return response()->json([
            'success' => true,
            'message' => "Todos fetched successfully",
            'data' => $todos
        ], 200);
    }

    // storing new todo
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:1', 'max:255']
        ]);

        $result = TodoModel::create($attributes);

        // this is async mail that hampers user experience. instead I will use queue and a job
        // !Mail::to("safwanridwan321@gmail.com")->send(
        //     new TodoMail()
        // );

        // this will do the email work without hampering the ux by not making it wait for the response.
        dispatch(new TodoJob());

        return response()->json([
            'success' => true,
            'message' => "Todo created successfully",
            'data' => $result
        ], 201);
    }

    // getting single todo
    public function show($id)
    {
        $todo = TodoModel::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => "Todo fetched successfully",
            'data' => $todo
        ], 200);
    }

    // updating single todo by id
    public function update($id)
    {
        $todo = TodoModel::findOrFail($id);
        $attributes = request()->validate([
            "title" => ['required', 'min:1', 'max:255']
        ]);

        $result = $todo->update($attributes);

        return response()->json([
            'success' => true,
            'message' => "Todo updated successfully",
            'data' => $result
        ], 201);
    }

    // deleting single todo by id
    public function destroy($id)
    {
        $todo = TodoModel::findOrFail($id);
        $result = $todo->delete();

        return response()->json([
            'success' => true,
            'message' => "Todo deleted successfully",
            'data' => $result
        ], 201);
    }

    // searching todo
    public function find()
    {
        $params = request()->query();

        // $result = TodoModel::select('SELECT * FROM todo WHERE title LIKE "%todo%"');
        $result = TodoModel::where('title', 'like', "%{$params["searchTerm"]}%")->get();
        return response()->json([
            'success' => true,
            'message' => "Todo fetched successfully",
            'data' => $result
        ], 200);
    }

    // marking complete
    public function markComplete($id)
    {
        $todo = TodoModel::find($id);

        $result = $todo->update([
            "isCompleted" => true
        ]);

        return response()->json([
            "success" => true,
            "message" => "Todo marked completed!",
            "data" => $result
        ], 201);
    }

    // getting summary of todos
    public function summary()
    {
        $total_todos = TodoModel::count();
        $total_pending_todos = TodoModel::where('isCompleted', 0)->count();
        $total_completed_todos = TodoModel::where('isCompleted', 1)->count();

        return response()->json([
            "success" => true,
            "message" => "Todo summary fetched!",
            "data" => [
                "totalTodos" => $total_todos,
                "totalPendingTodos" => $total_pending_todos,
                "totalCompletedTodos" => $total_completed_todos
            ]
        ], 200);
    }
}

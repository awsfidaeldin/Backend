<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {
    
public function __construct()
  {   
    $this->middleware('auth',
      ['only' => ['create', 'edit']]);
  } 


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
//	public function index()
//	{
//		$todos = Todo::orderBy('id', 'desc')->paginate(10);
//
//		return view('todos.index', compact('todos','duedate'));
//	}
    
     public function index(Request $request)
{
        $search = $request->input("search");

        if ($search != '')
        {
            $todos = Todo::where('todo', 'LIKE', '%'. $search .'%');
            $todos = $todos->paginate(10);
        }
        else
        {
            $todos = Todo::orderBy('id', 'desc')->paginate(10);
        }

        return view('todos.index', compact('todos'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('todos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        
		$todo = new Todo();
       
		$todo->todo = $request->input("todo");
        $todo->duedate = $request->input("duedate");
        
        $this->validate($request, [
        'todo' => 'required|max:255|min:5',
            
        'duedate' => 'required',
        
        ]);
        
		$todo->save();

		return redirect()->route('todos.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$todo = Todo::findOrFail($id);

		return view('todos.show', compact('todo','duedate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$todo = Todo::findOrFail($id);

		return view('todos.edit', compact('todo','duedate'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$todo = Todo::findOrFail($id);

		$todo->todo = $request->input("todo");
        $todo->duedate = $request->input("duedate");

		$todo->save();

		return redirect()->route('todos.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$todo = Todo::findOrFail($id);
		$todo->delete();
        

		return redirect()->route('todos.index')->with('message', 'Item deleted successfully.');
	}

}

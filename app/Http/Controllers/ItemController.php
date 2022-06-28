<?php

namespace App\Http\Controllers;

use app\Events\ItemCreated;
use App\Http\Requests\Post\ItemPostRequest;
use App\Http\Resources\ItemCollection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $items = Item::all();
//        $paginated = DB::table('items')->simplePaginate(3);
//        dd($paginated->links());
        return response(new ItemCollection($items));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function fetch()
    {
        return Item::with('user')->get();
    }

    public function store(ItemPostRequest $request)
    {

//        $user = Auth::user();
        $userid = auth()->user()->id;
        $validated = $request->validated();
        $item = new Item([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'user_id' => $userid
        ]);
        $item->save();

//         broadcast(new ItemCreated($user, $item))->toOthers();
//         event(new ItemCreated($item));
//        broadcast(new MessageSent($user, $message))->toOthers();
        return response()->json([
            'message' => 'Successfully added',
            'item' => $item
        ]);
    }
//    public function store(Request $request)
//    {
//        return response()->json([$request->all()]);
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPostRequest $request, $id)
    {
        $validated = $request->validated();
        $item = Item::find($id);
//        @TODO de scos comentariu omg
//        if($item->user_id != auth()->user()->id) {
//            return response()->json(['message' => 'This is not your item!'], 401);
//        }
        $item->fill($request->post())->save();
        return response()->json(
            [
                'message' => 'Item successfully updated!',
                'item' => $item
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item->user_id == auth()->user()->id) {
            $item->delete();
            return response()->json([
                'message' => 'Item successfully deleted!'
            ], 200);
        }
        else
        {
            return response()->json(['message' => 'This is not your item!'], 401);
        }
    }

    public function userid()
    {
        $userid = auth()->user()->id;
        return response()->json($userid);
    }
}

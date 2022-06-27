<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ItemPostRequest;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PriceResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class ItemController extends Controller
{
    public function indexLimited() // $items parameter
    {
//        $paginated = DB::table('items')->paginate();
//        $paginated = DB::table('items')->join('users', 'users.id', '=', 'items.user_id')
//            ->simplePaginate(5); // $items parameter instead of 5
        $test = DB::table('items')->paginate(5);
//        return response($test);
        return response($test);
    }

    public function index()
    {
        $items = Item::all();
        if ($items->isEmpty()) {
            return response(['error' => true, 'status' => http_response_code()], 404);
        } else
            return response(new ItemCollection($items), 200);
    }

    public function show($id)
    {
        $item = Item::where('id', $id)->firstOrFail();
        if ($item->exists()) {
            return response(new ItemResource($item));
        }
    }

    public function store(ItemPostRequest $request)
    {
        $validated = $request->validated();
        $item = Item::create(
            [
                'name' => $request->name,
                'price' => $request->price
            ]
        );
        if ($item->exists) {
            return response(new ItemResource($item));
        }
    }

//    public function price($sum)
//    {
//        $apikey = '2CE323D5-4E6D-450A-A805-2A0FD18A80E7';
////        $response = Http::get('https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey='.$apikey);
//        if (!Cache::has('rate')) {
//            $response = Http::get('https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey='.$apikey);
//            Cache::put('rate', $response['rate'], now()->addMinute(10));
//        }
//        $rate = Cache::get('rate');
//        $sum *= $rate;
//
//        return response($sum);
//
//    }

    public function price($sum)
    {
        $apikey = '2CE323D5-4E6D-450A-A805-2A0FD18A80E7';
        Cache::remember('rate', 600, function () use ($apikey) {
            $response = Http::get('https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=' . $apikey);
            return $response['rate'];
        });
        $sum *= Cache::get('rate');
        return response($sum);

    }


//    public function price($sum)
//    {
//        $apikey = '2CE323D5-4E6D-450A-A805-2A0FD18A80E7';
//        $response = Http::get('https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey='.$apikey);
//        Cache::put('rate', $response['rate'], now()->addMinute(10));
//
//        $sum *= $response['rate'];
//
//        return response($sum);
//
//    }


//    public function destroy(Request $request)
//    {
//        try
//        {
//            $ids = array_column($request->id, "id");
//            Item::whereIn('id', $ids)->delete();
//            return response()->json('Enquiry deleted');
//        }
//
//        catch (Exception $e) {
//            return response()->json($e->getMessage(), 500);
//        }
//    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListResponseResource;
use App\Http\Resources\ResponseResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * create
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'category'   => 'required',
            'price'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $latestData = Item::orderBy('kode', 'desc')->first();
        $latestId = $latestData ? $latestData->kode : null;
        $newId = StringHelpers::generateNewId('BRG_', $latestId);

        //insert
        $item = new Item;
        $item->kode = $newId;
        $item->nama = $request->name;
        $item->kategori = $request->category;
        $item->harga = $request->price;
        $item->save();

        //return response
        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $item);
    }

    /**
     * list
     *
     * @return void
     */
    public function index()
    {
        //get all
        $item = Item::paginate(10);

        $data = $item->items();

        $page = [
            "current_page" => $item->currentPage(),
            "last_page" => $item->lastPage(),
            "total" => $item->total(),
            "per_page" => $item->perPage(),
            "from" => $item->firstItem(),
            "to" => $item->lastItem(),
        ];

        //return collection of Item as a resource
        return new ListResponseResource(true, 'List Data', $page, $data);
    }

    /**
     * detail
     *
     * @param  mixed $item
     * @return void
     */
    public function show($id)
    {
        //find Item by ID
        $item = Item::find($id);

        //return single Item as a resource
        return new ResponseResource(true, 'Detail Data', $item);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $item
     * @return void
     */
    public function update(Request $request, $id)
    {
        $data = [];

        if ($request->name != null || $request->category != null || $request->price != null) {
            if ($request->name != null) {
                $data["nama"] = $request->name;
            }
            if ($request->category != null) {
                $data["kategori"] = $request->category;
            }
            if ($request->price != null) {
                $data["harga"] = $request->price;
            }
        } else {
            return response()->json("Tidak ada data yang diubah", 422);
        }

        //find post by ID
        $item = Item::find($id);

        //update post without image
        $item->update($data);

        //return response
        return new ResponseResource(true, 'Data Berhasil Diubah!', $item);
    }

    /**
     * delete
     *
     * @param  mixed $item
     * @return void
     */
    public function destroy($id)
    {

        //find Item by ID
        $item = Item::find($id);

        //delete Item
        $item->delete();

        //return response
        return new ResponseResource(true, 'Data Berhasil Dihapus!', null);
    }
}

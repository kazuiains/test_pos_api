<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListResponseResource;
use App\Http\Resources\ResponseResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
            'domicile'   => 'required',
            'gender'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $latestData = Customer::orderBy('id_pelanggan', 'desc')->first();
        $latestId = $latestData ? $latestData->id_pelanggan : null;
        $newId = StringHelpers::generateNewId('PELANGGAN_', $latestId);

        //insert
        $customer = new Customer;
        $customer->id_pelanggan = $newId;
        $customer->nama = $request->name;
        $customer->domisili = $request->domicile;
        $customer->jenis_kelamin = $request->gender;
        $customer->save();

        //return response
        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $customer);
    }

    /**
     * list
     *
     * @return void
     */
    public function index()
    {
        //get all
        $customer = Customer::paginate(10);

        $data = $customer->items();

        $page = [
            "current_page" => $customer->currentPage(),
            "last_page" => $customer->lastPage(),
            "total" => $customer->total(),
            "per_page" => $customer->perPage(),
            "from" => $customer->firstItem(),
            "to" => $customer->lastItem(),
        ];

        //return collection of customer as a resource
        return new ListResponseResource(true, 'List Data', $page, $data);
    }

    /**
     * detail
     *
     * @param  mixed $customer
     * @return void
     */
    public function show($id)
    {
        //find customer by ID
        $customer = Customer::find($id);

        //return single customer as a resource
        return new ResponseResource(true, 'Detail Data', $customer);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $customer
     * @return void
     */
    public function update(Request $request, $id)
    {
        $data = [];

        if ($request->name != null || $request->domicile != null || $request->gender != null) {
            if ($request->name != null) {
                $data["nama"] = $request->name;
            }
            if ($request->domicile != null) {
                $data["domisili"] = $request->domicile;
            }
            if ($request->gender != null) {
                $data["jenis_kelamin"] = $request->gender;
            }
        } else {
            return response()->json("Tidak ada data yang diubah", 422);
        }

        //find post by ID
        $customer = Customer::find($id);

        //update post without image
        $customer->update($data);

        //return response
        return new ResponseResource(true, 'Data Berhasil Diubah!', $customer);
    }

    /**
     * delete
     *
     * @param  mixed $customer
     * @return void
     */
    public function destroy($id)
    {

        //find customer by ID
        $customer = Customer::find($id);

        //delete customer
        $customer->delete();

        //return response
        return new ResponseResource(true, 'Data Berhasil Dihapus!', null);
    }
}

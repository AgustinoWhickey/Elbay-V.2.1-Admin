<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class SupplierController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/supplier?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $suppliers = array();

        if($userData){
            $suppliers = $userData->data->suppliers;
        }

        return view('admin/supplier/index', [
            'title' => 'Kelola Supplier',
            'slug' => 'kelola_supplier',
            'suppliers' => $suppliers,
        ]);
    }

    public function show($slug)
    {
        return view('post', [
            'title' => 'Artikel',
            'post' => Post::find($slug)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["supplier_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/supplier", $data);
        } else {
            api_data_post($_ENV['API_URL']."/supplier", $data);
        }   

    }

    public function edit($supplierid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/supplier?email='.Session::get('data')['email'].'&id='.$supplierid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->supplier;

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        dd($request->all);
        $data = [
			'supplier_id' => $request->id,
			'name' => $request->input('name'),
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->input('description'),
            'X-API-KEY' => 'restapi123'
		];

        return $data;
	
		api_data_put($_ENV['API_URL']."/branch", $data);
    }

    public function destroy($supplierid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$supplierid,
		];
	
		api_data_delete($_ENV['API_URL']."/supplier", $data);
    }
}

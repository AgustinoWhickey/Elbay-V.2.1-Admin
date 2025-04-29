<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class CartController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/sale?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $sales = array();

        if($userData){
            $items = $userData->data->items;
            $categories = $userData->data->category;
        }

        return view('admin/sales/index', [
            'title' => 'Kelola Sales',
            'slug' => 'kelola_sales',
            'items' => $items,
            'categories' => $categories,
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
            'item_id' => $request->item_id,
            'price' => $request->price,
            'qty' => $request->qty,
            'user_id' => Session::get('data')['user_id'],
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["item_id"] = $request->item_id;
            api_data_put($_ENV['API_URL']."/cart", $data);
        } else {
            api_data_post($_ENV['API_URL']."/cart", $data);
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

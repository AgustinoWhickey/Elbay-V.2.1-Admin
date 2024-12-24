<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class ItemController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/item?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $items = array();

        if($userData){
            $items = $userData->data->unititems;
        }

        return view('admin/item/index', [
            'title' => 'Kelola Item',
            'slug' => 'kelola_item',
            'items' => $items,
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
        $filename = '';
        $image = $request->image;
		if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = $request->name.'.'.$extenstion;
            $file->move('assets/images/item/', $filename);
        }

        $data = [
            'name' => $request->name,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'expired' => strtotime($request->expired),
            'image' => $filename,
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["item_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/item", $data);
        } else {
            api_data_post($_ENV['API_URL']."/item", $data);
        }   

    }

    public function edit($itemid)
    {
        $data = array();
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/item?email='.Session::get('data')['email'].'&id='.$itemid.'&X-API-KEY=restapi123'));

        if($getData){

            $data = [
                'id' => $getData->data->oneitem->id,
                'name' => $getData->data->oneitem->name,
                'satuan' => $getData->data->oneitem->unit,
                'harga_satuan' => $getData->data->oneitem->unit_price,
                'expired' => Date("Y-m-d", $getData->data->oneitem->expired_date) ,
                'image' => $getData->data->oneitem->image,
            ];
        }

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($itemid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$itemid,
		];
	
		api_data_delete($_ENV['API_URL']."/item", $data);
    }
}

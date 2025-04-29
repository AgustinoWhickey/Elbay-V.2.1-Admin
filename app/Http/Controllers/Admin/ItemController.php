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

    function byCategory(Request $request) {
		if($request->idcat){
			$getData = json_decode(api_data_get($_ENV['API_URL'].'/product?email='.Session::get('data')['email'].'&id='.$request->idcat.'&X-API-KEY=restapi123'));
		} else {
			$getData = json_decode(api_data_get($_ENV['API_URL'].'/product?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
		}

        if($getData){
            $items = $getData->data->items;
        }
		$html = '';

		foreach($items as $item){
            $html .= '<div class="col mb-2 col-lg-4">
                       <a href="#" id="item" stock="'.$item->stock.'" iditem="'.$item->id.'" product="'.$item->name.'" price="'.$item->price.'">
                       <div class="card">';
                           if($item->image != '') { 
                               $html .= '<img class="card-img-top rounded-circle p-2" src="'.env('APP_URL')."/assets/images/menu/".$item->image.'" style="height: 200px;" />';
                           } else {
                               $html .= '<img class="card-img-top rounded-circle p-2" src="'.env('APP_URL')."/assets/images/menu/default.jpg".'" style="height: 200px;" />';
                           } 
                           $html .= '<hr class="m-0">
                           <div class="card-body p-2">
                               <div class="text-center row">
                                   <div class="col-md-12">
                                       <h5 class="fw-bolder">'.$item->name.'</h5>
                                   </div>
                                   <div class="col-md-6 d-flex align-items-center justify-content-center">
                                       <b>'.indo_currency($item->price).'</b>
                                   </div>
                                   <div class="col-md-6 text-right">
                                       <div class="btn bg-transparent rounded-round border-2 btn-icon" style="cursor: pointer;">
                                           <i class="icon-plus3"></i>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       </a>
                   </div>';
       }

		echo $html;
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

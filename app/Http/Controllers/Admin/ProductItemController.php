<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class ProductItemController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/menuitem?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $menus = [];
        $categories = [];
        $items = [];
        $stocks = [];
        $finalitems = [];

        if($userData){
            $menus = $userData->data->menus;
            $categories = $userData->data->categories;
            $items = $userData->data->items;
            $stocks = $userData->data->stocks;

            $newresult = item_stocks($stocks);

            foreach($items as $item) {
                $qtystock = 0;
                foreach($newresult as $index => $value) {
                    if($item->id == $value['item_id']){
                        $qtystock = $value['stock'];
                    }
                }

                array_push($finalitems, 
                    (object)[
                        "id" => $item->id,
                        "name" =>  $item->name,
                        "unit" => $item->unit,
                        "unit_price" => $item->unit_price,
                        "image" => $item->image,
                        "expired_date" => $item->expired_date,
                        "item_stock"=> $qtystock, 
                        "created" => $item->created,
                        "updated" => $item->updated,
                    ]
                );
            }
        }

        return view('admin/menu/index', [
            'title' => 'Kelola Menu',
            'slug' => 'kelola_menu',
            'menus' => $menus,
            'categories' => $categories,
            'items' => $finalitems,
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
        $filename = 'default.jpg';
        $stock = '';
        $useitem = 0;
        $stockbahan = array();
        $image = $request->image;
		if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = $request->kode.'.'.$extention;
            $file->move('assets/images/menu/', $filename);
        } else {
            $filename = $request->old_image;
        }

        $items = (array) json_decode($request->items);
		$stockbahan = array();
		foreach($items as $key => $val){
			array_push($stockbahan, intval($val->stock/(int)$val->qty));
		}

        if (count($stockbahan) > 0) {
            $stock = min($stockbahan);
            $useitem = 1;
        } else {
            $stock = $request->stock;
            $useitem = 0;
        }

        $data = [
            'name' => $request->name,
            'code' => $request->kode,
            'category_id' => $request->kategori,
            'price' => $request->harga,
            'use_item' => $useitem,
            'stock' => $stock,
            'image' => $filename,
            'expired_date' => strtotime($request->kadaluarsa),
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["menu_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/menuitem", $data);
        } else {
            api_data_post($_ENV['API_URL']."/menuitem", $data);
        }   

    }

    public function edit($menuid)
    {
        $data = array();
        $finalitems = [];
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/menuitem?email='.Session::get('data')['email'].'&id='.$menuid.'&X-API-KEY=restapi123'));

        if($getData){
            $data = [
                'id' => $getData->data->item_stock->id,
                'name' => $getData->data->item_stock->name,
                'code' => $getData->data->item_stock->code,
                'category_id' => $getData->data->item_stock->category_id,
                'price' => $getData->data->item_stock->price,
                'use_item' => $getData->data->item_stock->use_item,
                'stock' => $getData->data->item_stock->stock,
                'image' => $getData->data->item_stock->image,
                'expired_date' => Date("Y-m-d",$getData->data->item_stock->expired_date),
            ];
        }

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($menuid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/menuitem?email='.Session::get('data')['email'].'&id='.$menuid.'&X-API-KEY=restapi123'));

        if($getData->data->item_stock->image != 'default.jpg') {
			unlink('assets/images/menu/'.$getData->data->item_stock->image);
		}

        $data = [
			'X-API-KEY' => 'restapi123',
			'product_id' => (int)$menuid,
		];
	
		api_data_delete($_ENV['API_URL']."/menuitem", $data);

    }
}

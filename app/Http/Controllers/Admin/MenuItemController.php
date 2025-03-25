<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class MenuItemController extends Controller
{
    public function index()
    {
        //
    }

    public function show($slug)
    {
       //
    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        $items = (array) json_decode($request->items);

        if($request->product) {

            $data_delete = [
                'X-API-KEY' => 'restapi123',
                'product_id' => (int)$request->product,
            ];
        
            api_data_delete($_ENV['API_URL']."/itemmenu", $data_delete);
            
        } 
        
        foreach($items as $key => $val){
            $data = [
                'product_id' => (int)$request->product,
                'item_id' => (int)$val->id,
                'qty' => (int)$val->qty,
                'X-API-KEY' => 'restapi123'
            ];
                
            api_data_post($_ENV['API_URL']."/itemmenu", $data);
            
        } 

    }

    public function edit($itemid)
    {
        $data = [];
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/itemmenu?email='.Session::get('data')['email'].'&id='.$itemid.'&X-API-KEY=restapi123'));

        if($getData){

            $stocks = $getData->data->stocks;
            $menus = $getData->data->item_menus;

            $result = array();
            foreach($stocks as $stock) {
                $id = $stock->item_id;
                if($stock->type=='in') {
                    $result[$id][] = (int)$stock->qty;
                } else {
                    $result[$id][] = -(int)$stock->qty;
                }
            }

            foreach($result as $key => $value) {
                $newresult[] = array('item_id' => $key, 'qty' => array_sum($value));
            }

            foreach($menus as $menu) {
                $qtystock = 0;
                foreach($newresult as $index => $value) {
                    if($menu->id == $value['item_id']){
                        $qtystock = $value['qty'];
                    }
                }

                array_push($data, 
                    (object)[
                        'id' => $menu->id,
                        'product_id' => $menu->product_id,
                        'item_id' => $menu->item_id,
                        'qty' => $menu->qty,
                        'stock' => $qtystock,
                        'name' => $menu->name,
                    ]
                );
            }

        }

		echo json_encode($data);
    }

    public function edittemp($menuid)
    {
        $data = array();
        $finalitems = [];
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/menuitem?email='.Session::get('data')['email'].'&id='.$menuid.'&X-API-KEY=restapi123'));

        if($getData){
            $stocks = $getData->data->stocks;
            $menus = $getData->data->menus;

            $result = array();
            foreach($stocks as $stock) {
                $id = $stock->item_id;
                if($stock->type=='in') {
                    $result[$id][] = (int)$stock->qty;
                } else {
                    $result[$id][] = -(int)$stock->qty;
                }
            }

            foreach($result as $key => $value) {
                $newresult[] = array('item_id' => $key, 'qty' => array_sum($value));
            }

            foreach($menus as $menu) {
                $qtystock = 0;
                foreach($newresult as $index => $value) {
                    if($menu->id == $value['item_id']){
                        $qtystock = $value['qty'];
                    }
                }

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

            echo "<pre>";
            print_r($menus);
            echo "</pre>";
            exit;
        }

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($menuid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'product_id' => (int)$menuid,
		];
	
		api_data_delete($_ENV['API_URL']."/itemmenu", $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class StockController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/stock?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $stocks = [];
        $suppliers = [];
        $unititems = [];
        $newresult = [];
        $finalresult = [];

        if($userData){
            $stocks = $userData->data->stocks;
            $suppliers = $userData->data->suppliers;
            $unititems = $userData->data->unititems;
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

            foreach($stocks as $stock) {
                $qtystock = 0;
                foreach($newresult as $index => $value) {
                    if($stock->item_id == $value['item_id']){
                        $qtystock = $value['qty'];
                    }
                }

                array_push($finalresult, 
                        (object)[
                            "id" => $stock->id, 
                            "item_id"=> $stock->item_id, 
                            "item_name"=> $stock->item_name, 
                            "detail"=> $stock->detail, 
                            "date"=> $stock->date, 
                            "qty"=> $stock->qty, 
                            "item_stock"=> $qtystock, 
                            "type"=> $stock->type, 
                            "supplier_id"=> $stock->supplier_id, 
                            "supplier_name"=> $stock->supplier_name, 
                        ]
                    );
            }
        }

        return view('admin/stock/index', [
            'title' => 'Kelola Stock',
            'slug' => 'kelola_stock',
            'stocks' => $finalresult,
            'suppliers' => $suppliers,
            'unititems' => $unititems,
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
            'item_id' => $request->name,
            'type' => 'in',
            'detail' => $request->detail,
            'supplier_id' => $request->supplier,
            'qty' => $request->qty,
            'user_id' => Session::get('data')['user_id'],
            'date' => strtotime($request->indate),
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["stock_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/stock", $data);
        } else {
            api_data_post($_ENV['API_URL']."/stock", $data);
        }   

    }

    public function edit($stockid)
    {
        $data = array();
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/stock?email='.Session::get('data')['email'].'&id='.$stockid.'&X-API-KEY=restapi123'));

        if($getData){
            $data = [
                'id' => $getData->data->stock->id,
                'item_id' => $getData->data->stock->item_id,
                'qty' => $getData->data->stock->qty,
                'supplier' => $getData->data->stock->supplier_id,
                'date' => Date("Y-m-d", $getData->data->stock->date),
                'detail' => $getData->data->stock->detail,
            ];
        }

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($stockid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$stockid,
		];
	
		api_data_delete($_ENV['API_URL']."/stock", $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class SalesController extends Controller
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

    public function processPayment(Request $request){
		$carts = array();
		$stocks = array();
        $row = [];

		$sale_id = $request->saleid;
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/sale?email='.Session::get('data')['email'].'&id='.Session::get('data')['user_id'].'&X-API-KEY=restapi123'));
		if($getData){
            $carts = $getData->data->cart;
        }

		foreach($carts as $value){
			$cartDetail = [
				'sale_id' => $sale_id,
				'item_id' => $value->item_id,
				'price' => $value->price,
				'qty' => $value->qty,
				'discount_item' => $value->discount_item,
				'total' => $value->total,
				'user_id' => Session::get('data')['user_id'],
				'X-API-KEY' => 'restapi123'
            ];

            api_data_post($_ENV['API_URL'].'/saledetail', $cartDetail);

            $getDataItem = json_decode(api_data_get($_ENV['API_URL'].'/item?email='.Session::get('data')['email'].'&id='.$value->item_id.'&X-API-KEY=restapi123'));
            if($getDataItem) {
                $stocks = (array) $getDataItem->data;
            }

            if (isset($getDataItem->data->onemenuitem)) {
                foreach($stocks['onemenuitem'] as $stock){
                    $data = [
                        'item_id' => (int)$stock->item_id,
                        'type' => 'out',
                        'detail' => 'Pembelian Produk',
                        'supplier_id' => '0',
                        'qty' => $stock->qty,
                        'user_id' => Session::get('data')['user_id'],
                        'date' => strtotime('now'),
                        'X-API-KEY' => 'restapi123'
                    ];
    
                    api_data_post($_ENV['API_URL'].'/stock', $data);
                } 
            } else {
                $data = [
                    'id' => $getDataItem->data->item->id,
                    'type' => 'stockout',
                    'stock' => $value->qty,
                    'X-API-KEY' => 'restapi123'
                ];
               api_data_put($_ENV['API_URL']."/menuitem", $data);
            }
		}

        product_stock_by_sale($sale_id);

        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => Session::get('data')['user_id'],
		];

        api_data_delete($_ENV['API_URL']."/cart", $data);
		
	}

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        $data = [
			'discount' => $request->discount,
			'grandtotal' => $request->grandtotal,
			'cash' => $request->cash,
			'change' => $request->change,
			'note' => $request->note,
            'user_id' => Session::get('data')['user_id'],
			'X-API-KEY' => 'restapi123'
		];

        if($request->id) {
            $data["sales_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/sale", $data);
        } else {
            api_data_post($_ENV['API_URL']."/sale", $data);
        }   

    }

    public function edit($supplierid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/supplier?email='.Session::get('data')['email'].'&id='.$supplierid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->supplier;

		echo json_encode($data);
    }

    public function cetak($id)
	{
        product_stock_by_sale($id);
        exit;

        $saleData = array();
		$saleDetailData = array();

        $getSaleData = json_decode(api_data_get($_ENV['API_URL'].'/sale?email='.Session::get('data')['email'].'&id='.$id.'&X-API-KEY=restapi123'));
        if($getSaleData->data->sale) {
            $saleData = $getSaleData->data->sale;
        }

        $getSaleDetailData = json_decode(api_data_get($_ENV['API_URL'].'/saledetail?email='.Session::get('data')['email'].'&id='.$id.'&X-API-KEY=restapi123'));
        if($getSaleDetailData->data->saledetail) {
            $saleDetailData = $getSaleDetailData->data->saledetail;
        }

        return view('admin/sales/receipt', [
            'title' => 'Kelola Sales',
            'sale' => $saleData,
            'sale_detail' => $saleDetailData
        ]);
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

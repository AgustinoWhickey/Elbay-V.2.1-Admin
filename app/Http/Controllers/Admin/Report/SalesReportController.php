<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class SalesReportController extends Controller
{
    public function index()
    {
        $salesData = json_decode(api_data_get($_ENV['API_URL'].'/sale?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $salesReport = array();

        if($salesData){
            $salesReport = $salesData->data->sales;
        }

        return view('admin/report/sales/index', [
            'title' => 'Kelola Sales Report',
            'slug' => 'kelola_sales_report',
            'sales' => $salesReport,
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
        // 

    }

    public function edit($saleid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/saledetail?email='.Session::get('data')['email'].'&id='.$saleid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->saledetail;

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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class BranchController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/branch?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));

        return view('admin/branch/index', [
            'title' => 'Kelola Cabang',
            'slug' => 'kelola_cabang',
            'branches' => $userData->data->branches,
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
            'company_id' =>  number_format($request->session()->get('data')['company_id']),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["branch_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/branch", $data);
        } else {
            api_data_post($_ENV['API_URL']."/branch", $data);
        }   

    }

    public function edit($branchid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/branch?email='.Session::get('data')['email'].'&id='.$branchid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->branch;

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        dd($request->all);
        $data = [
			'branch_id' => $request->id,
			'name' => $request->input('name'),
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->input('description'),
            'X-API-KEY' => 'restapi123'
		];

        return $data;
	
		api_data_put($_ENV['API_URL']."/branch", $data);
    }

    public function destroy($branchid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$branchid,
		];
	
		api_data_delete($_ENV['API_URL']."/branch", $data);
    }
}

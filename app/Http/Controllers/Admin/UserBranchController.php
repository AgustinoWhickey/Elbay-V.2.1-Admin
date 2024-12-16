<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class UserBranchController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/userbranch?email='.Session::get('data')['email'].'&company_id='.Session::get('data')['company_id'].'&X-API-KEY=restapi123'));
        $branches = array();
        $users = array();
        $userbranches = array();

        if($userData){
            $branches = $userData->data->branches;
            $users = $userData->data->users;
		    $userbranches = $userData->data->userbranches;
        }

        return view('admin/userbranch/index', [
            'title' => 'Pengelola Cabang',
            'slug' => 'pengelola_cabang',
            'branches' => $branches,
            'users' => $users,
            'userbranches' => $userbranches,
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
            'cabang' => $request->cabang,
            'pegawai' => $request->pegawai,
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["userbranch_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/userbranch", $data);
        } else {
            api_data_post($_ENV['API_URL']."/userbranch", $data);
        }   

    }

    public function edit($userbranchid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/userbranch?email='.Session::get('data')['email'].'&id='.$userbranchid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->userbranch;

		echo json_encode($data);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($userbranchid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$userbranchid,
		];
	
		api_data_delete($_ENV['API_URL']."/userbranch", $data);
    }
}

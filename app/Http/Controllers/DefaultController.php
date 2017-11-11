<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class DefaultController extends Controller
{
	


	public function call()
	{
		Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
        });
	}
		public function getGitData(){
			
			GitHub::me()->organizations();
			$data = GitHub::search()->repositories('symfony');
			
			foreach($data['items'] as $val)
			{
				$repoId = $val['id'];
				$repoResponse = base64_encode(serialize($val));
				
				$rows = DB::table('repodata')
				->where("repoId",$repoId)
				->get();
				$rows = json_decode($rows);
				
				
				if(count($rows) < 1){
					DB::table('repodata')->insert(
					['repoId' => $repoId, 'RepoResponse' => $repoResponse]
				);
				}
				
				
			}
			echo "data retrive successfull.";
			//print_r($data);exit;
		}
		public function index(){
			
			$rows = DB::table('repodata')
				->get();
				$data['rows'] = json_decode($rows);
				
				return view('gitdata')->with($data);
			
		}
		
		public function viewData($id){
			
			$rows = DB::table('repodata')
				->get();
				$data['rows'] = json_decode($rows);
				$rows = DB::table('repodata')
				->where("repoId",$id)
				->get();
				$rows = json_decode($rows);
				//print_r($rows);exit;
			$response = unserialize(base64_decode($rows[0]->repoResponse));
			
				
			
				return json_encode($response);
		}
    //
}

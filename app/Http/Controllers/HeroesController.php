<?php

namespace App\Http\Controllers;

use App\Models\Heroes;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroesController extends Controller
{

    protected $hash; // variável hash utilizada para obter dados da API Marvel
    protected $ts; // variável ts utilizada para obter dados da API Marvel
    protected $params; // Parametros obrigatorios para solicitação

    public function __construct()
    {
        $this->ts = time();
        $this->hash = Heroes::getHash($this->ts);
        $this->params = '?apikey='.env('MARVEL_PUBLIC_KEY').'&hash='.$this->hash.'&ts='.$this->ts;
    }

    public function getHeroById($heroId) 
    {
        $heroData = collect();
        $response = Http::get(env('MARVEL_END_POINT').'characters/'.$heroId.$this->params);

        if($response->status() !== 200) {
            return response(['status' => 'error', 'msg' => 'Hero not found'], 400);
        }

        $data = collect($response->json());

        $heroData = $heroData->push([
            'id' => $data['data']['results'][0]['id'],
            'name'=> $data['data']['results'][0]['name'],
            'description'=> $data['data']['results'][0]['description'],
            'thumb'=> $data['data']['results'][0]['thumbnail']['path'].'/detail.'.$data['data']['results'][0]['thumbnail']['extension'], 
        ]);

        return $heroData->first();

    }

    public function getHeroByName(Request $request) 
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validated->fails()) {
            return response($validated->errors(), 400);
        }

        $heroData = collect();
        $response = Http::get(env('MARVEL_END_POINT').'characters'.$this->params.'&name='.$request->name);

        if($response->status() !== 200) {
            return response(['status' => 'error', 'msg' => 'Hero not found'], 400);
        }

        $data = collect($response->json());

        if($data['data']['count'] == 0) {
            return response(['status' => 'error', 'msg' => 'Hero not found'], 400);
        }

        $heroData = $heroData->push([
            'id' => $data['data']['results'][0]['id'],
            'name'=> $data['data']['results'][0]['name'],
            'description'=> $data['data']['results'][0]['description'],
            'thumb'=> $data['data']['results'][0]['thumbnail']['path'].'/detail.'.$data['data']['results'][0]['thumbnail']['extension'], 
        ]);

        return $heroData->first();

    }    

    public function getStoriesByHeroId($heroId)
    {
        $heroData = collect();
        $response = Http::get(env('MARVEL_END_POINT').'characters/'.$heroId.'/stories'.$this->params.'&limit=5');
        
        if($response->status() !== 200) {
            return response(['status' => 'error', 'msg' => 'Hero not found'], 400);
        }

        $data = collect($response->json());

        if($data->count() == 0) {
            return response(['status' => 'error', 'msg' => 'Hero not found'], 404);
        }

        for ($i=0; $i < $data['data']['count']; $i++) { 
            $heroData = $heroData->push([
                'id' => $data['data']['results'][$i]['id'],
                'title'=> $data['data']['results'][$i]['title'],
                'description'=> $data['data']['results'][$i]['description'],
                'modified' => $data['data']['results'][$i]['modified'],
                'creators' => $data['data']['results'][$i]['creators'],
                'characters' => $data['data']['results'][$i]['characters'],
            ]);
        }



        return $heroData->all();
    }

}

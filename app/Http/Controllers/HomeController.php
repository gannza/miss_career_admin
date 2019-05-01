<?php

namespace App\Http\Controllers;
use App\Models\MainStockTransctions;
use App\Models\WarehouseTransction;
use App\Models\Branches;
use App\Models\stockMovements;
use Log;
class HomeController extends AppBaseController
{

    public function __construct()
    {
       
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return !$this->authorized()?view('anauthorized.index'): view('home')
        ->with('warehouse', $this->warehouseAnalytics())
        ->with('mainstock', $this->mainstockAnalytics())
       ->with('stocks', $this->branchAnalytics());
    }

    function warehouseAnalytics(){
        $warehouse=WarehouseTransction::get();
        $percentage=0;
        $addedqty=[]; 
        $removedqty=[];
         $transferedqty=[];
        if(count($warehouse) > 0){
            foreach($warehouse as $w){
                $addedqty[]=$w->added_qty;
                $removedqty[]=$w->removed_qty;
                $transferedqty[]=$w->transfered_qty;
            }
        }
        $currentQty=($this->arrayAdd($addedqty)-($this->arrayAdd($removedqty)+$this->arrayAdd($transferedqty)));
        $percentage=$currentQty==0? $currentQty: $currentQty * 100 / $this->arrayAdd($addedqty);
       return ['percentage'=>$percentage,'current'=>$currentQty];

    }

    function mainstockAnalytics(){
        $mainstock=MainStockTransctions::get();
        $percentage=0;
        $addedqty=[]; 
        $removedqty=[];
         $transferedqty=[];
        if(count($mainstock) > 0){
            foreach($mainstock as $w){
                $addedqty[]=$w->added_qty;
                $removedqty[]=$w->removed_qty;
                $transferedqty[]=$w->transfered_qty;
            }
        }
        $currentQty=($this->arrayAdd($addedqty)-($this->arrayAdd($removedqty)+$this->arrayAdd($transferedqty)));
        $percentage=$currentQty==0? $currentQty: $currentQty * 100 / $this->arrayAdd($addedqty);
       return ['percentage'=>$percentage,'current'=>$currentQty];

    }
    function branchAnalytics(){
        $branches=Branches::get();
        $collection=[];
        $s=[];
        foreach($branches as $b){
           $s['name']=$b->name;
           $s['percentage']=$this->stockAnalytics($b->id)['percentage'];
        
            $s['text_color']=$this->getTexColor($s['percentage']);
           
           $s['current']=$this->stockAnalytics($b->id)['current'];
            $collection[]=$s;

        }
        return  $collection;
    }

function getTexColor($p){
    if($p == 100){
        return 'text-success';
       }
        if($p <= 70 && $p > 100){
           Log::info('prima');
             return 'text-primary';
        }
        
        if($p > 70 && $p <= 50){
            return 'text-info';
       }
        if($p > 50 && $p <= 1){
        return 'text-warning';
       } 
       
        if($p <= 0){
        return 'text-danger';
       }
}

    function stockAnalytics($branch_id){
        $stocks=stockMovements::where('branch_id',$branch_id)->get();
        $percentage=0;
        $addedqty=[]; 
        $removedqty=[];
         $transferedqty=[];
        if(count($stocks) > 0){
            foreach($stocks as $w){
                $addedqty[]=$w->added_qty;
                $removedqty[]=$w->removed_qty;
                $transferedqty[]=$w->transfered_qty;
            }
        }
       
        $currentQty=($this->arrayAdd($addedqty)-($this->arrayAdd($removedqty)+$this->arrayAdd($transferedqty)));
    
      $percentage=$currentQty==0? $currentQty: $currentQty * 100 / $this->arrayAdd($addedqty);

       return ['percentage'=>$percentage,'current'=>$currentQty];
    }

   
}

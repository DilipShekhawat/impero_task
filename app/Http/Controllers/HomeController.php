<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PracticalTests;
use App\ImportExcel;
use Maatwebsite\Excel\Facades\Excel;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        set_time_limit(8000000);
    }
   
    public function index(Request $request)
    {
        // pluck out unique product names from table
        $products= $selectedProduct=[];
        $products = PracticalTests::pluck('product_name')->unique()->toArray();
        // getting all products by default
        $data = PracticalTests::get();
        if($request['daterange']){
            $dates=  explode('-', $request['daterange']);
            $data = PracticalTests::whereBetween('order_date',[date('Y-m-d',strtotime($dates[0])),date('Y-m-d',strtotime($dates[1]))])->get();
        }
        if($request['productNames']){
            $selectedProduct=$request['productNames'];
            $data = PracticalTests::whereIn('product_name',$request['productNames'])->get();
        }
        if(!empty($data)){
            $data =  $data->toArray();
        }
        return view('welcome',compact('data','products','selectedProduct'));
    }
    public function Upload(Request $request)
    {
        $extensions = array("xls","xlsx");

        $result = array($request->file('document')->getClientOriginalExtension());

        if(in_array($result[0],$extensions)){
            Excel::import(new ImportExcel,request()->file('document'));
            toastr()->success('file uploaded successfully');
            return redirect()->route('welcome');
        }else{
            toastr()->error('File type should be xls, xlsx');
            return redirect()->route('add_excel');
        }
    
    }

}

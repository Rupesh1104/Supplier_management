<?php

namespace App\Http\Controllers;

use App\SupplierManagement;
use Illuminate\Http\Request;
use App\Country;
use App\Category;
use Exception;

class SupplierManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries= Country::all();
        $categories= Category::where('status',1)->get();
        $suppliers= SupplierManagement::where('status',1)->get();
        $countryArr=Country::pluck('country_name','id');
        $categoryArr=Category::pluck('category','id');

        return view('supplier.index',compact('countries','categories','suppliers','countryArr','categoryArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier' => 'required|max:255',
            'category' => 'required|max:255',
        ]);

        try{
        $obj = new SupplierManagement();
        $obj->country = $request->country;
        $obj->category = $request->category;
        $obj->supplier = $request->supplier;
        $obj->supplier_category = $request->supplier."_".$request->category;
        $is_saved=$obj->save();
        }
        catch(Exception $exception){
            if($exception->errorInfo[1]==1062)
            {
                return redirect('/supplier')->withErrors(['error' =>'Duplicate Entry']);
            }
        }
        if($is_saved)
        {
            return redirect('/supplier')->with('Message','Record has been Submitted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupplierManagement  $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierManagement $supplierManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupplierManagement  $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries= Country::all();
        $categories= Category::where('status',1)->get();
        $supplier= SupplierManagement::find($id);
        $countryArr=Country::pluck('country_name','id');
        $categoryArr=Category::pluck('category','id');

        return view('supplier.editSupplier',compact('countries','categories','supplier','countryArr','categoryArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupplierManagement  $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'supplier' => 'required|max:255',
            'category' => 'required|max:255',
        ]);

        try{
        $obj = SupplierManagement::find($id);
        $obj->country = $request->country;
        $obj->category = $request->category;
        $obj->supplier = $request->supplier;
        $obj->supplier_category = $request->supplier."_".$request->category;
        $is_saved=$obj->save();
        }
        catch(Exception $exception){
            if($exception->errorInfo[1]==1062)
            {
                return redirect('/supplier')->withErrors(['error' =>'Duplicate Entry']);
            }
        }
        if($is_saved)
        {
            return redirect('/supplier')->with('Message','Record has been Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupplierManagement  $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delRec(Request $request)
    {
        $objDel= SupplierManagement::find($request->code);
        $objDel->status=0;
        $is_del=$objDel->save();
        if($is_del)
            return response()->json('Record has been deleted');
    }
}

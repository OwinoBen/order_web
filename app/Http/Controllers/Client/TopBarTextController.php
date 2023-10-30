<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\TopBarText;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TopBarTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $domain, $id)
    { 
        $this->validate($request,[
            'banner_image'=>'required',
            'bold_text'=>'required|max:15',
            'normal_text'=>'required|max:25'
         ]);

         if($request->hasFile('banner_image')){
            $image = $request->file('banner_image');
            $folderName='banner';
            $filePath = $folderName . '/' . \Str::random(40);
            $file_name = Storage::disk('s3')->put($filePath, $image, 'public');
            $data['banner_image'] =  $file_name;

            if ( $id > 0 ){
                $topBar =  TopBarText::find($id);
            }else{
                $topBar = new TopBarText;
            }
            $topBar->bold_text = $request->bold_text;
            $topBar->normal_text = $request->normal_text;
            $topBar->banner_image = $file_name;
            $topBar->link = $request->assignTo;
            $topBar->redirect_category_id =  $request->category_id;
            $topBar->redirect_vendor_id =  $request->vendor_id;
            if($topBar->save()) {
            return redirect()->back()->with('success', 'Top Bar Text Updated Successfully!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

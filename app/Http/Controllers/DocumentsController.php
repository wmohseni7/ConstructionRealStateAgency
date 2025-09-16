<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Documents;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Block\Element\Document;
use PHPUnit\Framework\CoveredCodeNotExecutedException;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::get();
        $docs     = Documents::get();
        return view('pages.TheDocs.index',['agencies' => $agencies ],['doc'=> $docs]);
    }
    public function documents(){
        $docs=Documents::all();
        return response()->json([
            'data'=>$docs,
        ]);
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
        if($request->input('doc_id'))
        {
            $validation1= Validator::make($request->all(),[
                'agency'       => 'required',
                'subject'      => 'required',
                'date'         => 'required|before:tomorrow',
                'category'     => 'required',
                'doc'          => 'image|mimes:jpeg,jpg,png,gif|max:10000',
                'description'  => 'required',
            ],[
                'agency.required'       => 'نمایندکی را انتخاب نمایید',
                'subject.required'      => 'عنوان سند را وارد کنید',
                'date.required'         => 'تاریخ ثبت سند را وارد کنید',
                'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',
                'category.required'     => 'کتگوری سند را انتخاب کنید',
                'doc.image'             => 'فایل آپلود شده باید تصویر باشد',
                'doc.mimes'             => 'فایل آپلود شده باید با پسوند های jpeg,jpg,png,gif باشد',
                'description.required'  => 'توضیحات سند ضروری می باشد',
            ]);
            if ($validation1->passes()) {
                if($request->hasFile('doc')){
                    $doc=Documents::find($request->input('doc_id'));
                    unlink($doc->document);
                    $extension      = $request->file('doc')->getClientOriginalExtension();
                    $dir            = 'assets/storage/images/Documents/';
                    $filename       = uniqid().'_'. time(). '.' . $extension;
                    $request->file('doc')->move($dir,$filename);
                    $image_path     = $dir.$filename;
                    $updated=Documents::where('id',$request->input('doc_id'))->update([
                        'agency_id'     => $request->input('agency'),
                        'subject'       => $request->input('subject'),
                        'date'          => $request->input('date'),
                        'category'      => $request->input('category'),
                        'document'      => $image_path,
                        'description'   => $request->input('description'),
                        ]);
                        if ($updated) {
                            return response()->json([ 'success' => 'تغییرات موفقانه اعمال شد']);
                        }
                    else{
                        return response()->json(['error' => $validation1->errors()->all()]);
                    }
                }
                else{
                    $updated=Documents::where('id',$request->input('doc_id'))->update([
                        'agency_id'     => $request->input('agency'),
                        'subject'       => $request->input('subject'),
                        'date'          => $request->input('date'),
                        'category'      => $request->input('category'),
                        'description'   => $request->input('description'),
                        ]);
                        if ($updated) {
                            return response()->json([ 'success' => 'تغییرات موفقانه اعمال شد']);
                        }
                    else{
                        return response()->json(['error' => $validation1->errors()->all()]);
                    }
                }
            }

        }
        else{
        $validation= Validator::make($request->all(),[
            'agency'       => 'required',
            'subject'      => 'required',
            'date'         => 'required|before:tomorrow',
            'category'     => 'required',
            'doc'          => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
            'description'  => 'required',
        ],[
            'agency.required'       => 'نمایندکی را انتخاب نمایید',
            'subject.required'      => 'عنوان سند را وارد کنید',
            'date.required'         => 'تاریخ ثبت سند را وارد کنید',
            'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',
            'category.required'     => 'کتگوری سند را انتخاب کنید',
            'doc.required'          => 'عکس سند را وارد کنید',
            'doc.image'             => 'فایل آپلود شده باید تصویر باشد',
            'doc.mimes'             => 'فایل آپلود شده باید با پسوند های jpeg,jpg,png,gif باشد',
            'description.required'  => 'توضیحات سند ضروری می باشد',
        ]);
        if ($validation->passes()) {

            $extension      = $request->file('doc')->getClientOriginalExtension();
            $dir            = 'assets/storage/images/Documents/';
            $filename       = uniqid().'_'. time(). '.' . $extension;
            $request->file('doc')->move($dir,$filename);
            $image_path     = $dir.$filename;


            $document=[
            'agency_id'     => $request->input('agency'),
            'subject'       => $request->input('subject'),
            'date'          => $request->input('date'),
            'category'      => $request->input('category'),
            'document'      => $image_path,
            'description'   => $request->input('description'),
            
            ];
            $inserted=Documents::create($document);
            if ($inserted) {
                return response()->json([ 'success' => 'سند موفقانه اضافه شد']);
            }
        }
        else{
            return response()->json(['error' => $validation->errors()->all()]);
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document=Documents::find($id);
        return response()->json([
            'docs'=>$document,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Documents::where('id',$id)->first();
        return response()->json([
            'docs'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   try{
        $doc=Documents::find($id);
        unlink($doc->document);
        } catch(CoveredCodeNotExecutedException $e){
            
        }
        Documents::find($id)->delete();
    }
}

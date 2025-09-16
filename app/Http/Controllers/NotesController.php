<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes=Notes::get();
        return view('pages.Notes.index',['notes'=> $notes]);
    }
    public function notes(){
        $notes=Notes::all();
        return response()->json([
            'data'=>$notes,
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
        $validation = Validator::make($request->all(),[
            'writer'        => 'required',
            'subject'       => 'required',
            'description'   => 'required',
        ],[
            'writer.required'      => 'اسم نویسنده یادداشت را وارد کنید',
            'subject.required'     => 'عنوان یادداشت را وارد کنید',
            'description.required' => 'توضیحات درمورد یادداشت را وارد کنید',
        ]);
        if ($validation->passes()) {
            $note=[
                'writer'       => $request->input('writer'),
                'subject'      => $request->input('subject'),
                'description'  => $request->input('description'),
            ];
               $inserted = Notes::Create($note);
            if($inserted){
                return response()->json(['success' => 'یادداشت موفقانه اضافه شد']);
            }
        }
        else{
            return response()->json(['error' => $validation->errors()->all()]);
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
        $notes=Notes::find($id);
        return response()->json([
            'notes'=>$notes,
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
        $validation = Validator::make($request->all(),[
            'writer'        => 'required',
            'subject'       => 'required',
            'description'   => 'required',
        ],[
            'writer.required'      => 'اسم نویسنده یادداشت را وارد کنید',
            'subject.required'     => 'عنوان یادداشت را وارد کنید',
            'description.required' => 'توضیحات درمورد یادداشت را وارد کنید',
        ]);
        if ($validation->passes()) {
            $updated  = Notes::where('id',$request->input('note_id'))->update([
                'writer'        => $request->input('writer'),
                'subject'       => $request->input('subject'),
                'description'   => $request->input('description'),
            ]);

            if($updated){
                return response()->json(['success' => 'تغییرات موفقانه اعمال شد']);
            }
        }
        else{
            return response()->json(['error' => $validation->errors()->all()]);
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
        Notes::find($id)->delete();
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list for all category
        $categories=Category::all() ;// return collection obj class
        // return all category date from the date base by category model
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create a form for category

        $parents=Category::all();
        $category=new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store in db
        //طرق الوصول للداتا الي بالريكوست
        // $request->input('name'); // regredles get or post request
        // $request->post('name');
        // $request->query('string');//from url

        // $request->all(); // return array of all input date
        // $request->only(['name','parent_id']);
        // $request->except(['image','status']);

        // $category=new Category($request->all());//obj and return array
        // $category->save();
       $request->validate(Category::rules());


        // request merage
        $request->merge([
            'slug' => Str::Slug($request->post('name'))
        ]);

        $date=$request->except('image');
       $date['image']=$this->UploadedImage($request);// append from function

        //mass assigment
        $category=Category::create($date);//one line
        // not return the value of slug because its not in form so we make request merage

        //PRG (Post redirect get) // return any request to get
        return Redirect::route('dashboard.categories.index')
        ->with('success','category created');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show for specific category
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // edit the form of catgory
        try{
        $category=Category::find($id);// reurn obj from model
        }catch(Exception $e){
        if(!$category){
            return redirect()->route('dashboard.categories.index')
            ->with('info','Record not found');
        }
    }

        // all(select* from category where id <> $id (not equal)) And parent_id = $id
        // بمعنى م يكون ال id الحالي
        // ولا يكون ابن عشان اقدر اعدل القيمة
        $parents=Category::where('id' ,'<>', $id)
        ->where(function($query) use ($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','<>',$id);

        })
        ->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // show the new update
        // put method send date
        $request->validate(Category::rules($id));

        $category=Category::findOrFail($id);
        $old_image=$category->image;
        $date['image']=$this->UploadedImage($request);// append from function

        $category->update($date);
        if($old_image && isset($date['image']))
        {
            Storage::disk('public')->delete($old_image);
        }
        return redirect::route('dashboard.categories.index')
            ->with('success','Category updated');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the catgoty


        $category=Category::findOrFail($id);
        $category->delete();// delete the obk from the datebase

        if($category->image){
            storage::disk('public')->delete($category->image);
        }

        Category::destroy($id);

        return redirect::route('dashboard.categories.index')
        ->with('success','Category deleted');
    }

    protected function UploadedImage(Request $request)
    {
        if(!$request->hasFile('image')){  // name of field in the form
           return;
            //    $file->getClientOriginalName();
        //    $file->getSize();
        //    $file->getClientOriginalExtension();
        //    $file->getMimeType();
        }

        {
           $file= $request->file('image'); //uploaded file obj
         $path= $file->store('uploads',[
            'disk' => 'public',
            // store in upload folder
           //file system is local disk (in app folder)
           // cant reach for it from browzer it just local disk
           //and there is public disk
           ]);
           return $path;

        }

    }
}

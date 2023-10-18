<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\BlogCategory;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::table('blogs');

        if ( !empty( $request->f_soft_delete ) ) {
            if ($request->f_soft_delete == 1) {
                $query->where('deleted_at', '=', null);
            } else {
                $query->where('deleted_at', '!=', null);
            }
        }

        if ( !empty( $request->f_status ) ) {
            if ($request->f_status == 1){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        $blogs = $query->orderByDesc('id')->get();

        if ($request->ajax()) {
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $html = '';

                    $html .='<div class="btn-group" role="group" aria-label="Button group with nested dropdown">';
                    $html .='<div class="btn-group" role="group">';
                    $html .='<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                    $html .='Action';
                    $html .='</button>';
                    $html .='<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                    if ($row->deleted_at == null) {
                        $html .='<li><a class="dropdown-item" href="'. route('admin.blog.edit', $row->id) .'" id="edit_btn">Edit</a></li>';
                        $html .='<li><a class="dropdown-item" href="'. route('admin.blog.destroy', $row->id) .'" id="delete_btn">Delete</a></li>';
                    } else {
                        $html .='<li><a class="dropdown-item" href="'. route('admin.blog.restore', $row->id) .'" id="restore_btn">Restore</a></li>';
                        $html .='<li><a class="dropdown-item" href="'. route('admin.blog.forcedelete', $row->id) .'" id="force_delete_btn">Hard Delete</a></li>';
                    }
                    $html .='</ul>';
                    $html .='</div>';
                    $html .='</div>';

                    return $html;
                })
                ->addColumn('checkbox', function ($row) {
                    $html = '';

                    $html .= '<input type="checkbox" class="checkbox_ids" name="ids" value="'. $row->id .'">';

                    return $html;

                })
                ->addColumn('created_by', function ($row) {

                    if (!empty($row->created_by_id))
                    {
                        $user = User::where('id', $row->created_by_id)->first();

                        return $user->first_name . ' ' . $user->last_name;
                    }else{
                        return 'N/A';
                    }
                })
                ->addColumn('updated_by', function ($row) {

                    if (!empty($row->updated_by_id))
                    {
                        $user = User::where('id', $row->updated_by_id)->first();
                        return $user->first_name . ' ' . $user->last_name;
                    }else{
                        return 'N/A';
                    }
                })
                ->editColumn( 'image', function ( $row ) {

                    $html = '';
                    $html .='<a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Username" data-bs-original-title="Username">';
                    $html .='<img src="'. asset('uploads/blog/' . $row->image) . '" alt="" class="rounded-circle avatar-xxs"></a>';
                    $html .='</a>';

                    return $html;

                } )
                ->editColumn( 'blog_category', function ( $row ) {

                    return $row->id;

                } )
                ->editColumn('status', function ($row) {
                    $html = '';
                    if ($row->status == 1) {

                        $html .='<div class="form-check form-switch">';
                        $html .='<input class="form-check-input" href="'. route('admin.blog.deactive', $row->id) .'" type="checkbox" role="switch" id="deactive_btn" checked="">&nbsp;';
                        $html .='<label class="form-check-label" for="SwitchCheck4"> Active</label>';
                        $html .='</div>';

                    } else {
                        $html .='<div class="form-check form-switch">';
                        $html .='<input class="form-check-input" type="checkbox" href="'. route('admin.blog.active', $row->id) .'" role="switch" id="active_btn">&nbsp;';
                        $html .='<label class="form-check-label" for="SwitchCheck4"> De-active</label>';
                        $html .='</div>';
                    }
                    return $html;
                })
                ->rawColumns(['action', 'status', 'checkbox', 'image', 'blog_category'])
                ->make(true);
        }


        // $total_category =

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategories = BlogCategory::where('status', 1)->get();

        return view('admin.blog.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $formData = $request->validated();


        $formData['created_by_id'] = \auth::user()->id;


        if ($formData['status'] == 1) {
            $formData['status'] = true;
        }else {
            $formData['status'] = false;
        }

        if( $request->hasFile('image') ) {
            $image = Image::make($request->file('image'));

            $imageName = time().'-'.$request->file('image')->getClientOriginalName();

            // dd($imageName);

            $destinationPath = public_path('uploads/blog/');

            $image->save($destinationPath.$imageName);

            $formData['image'] = $imageName;
        }
        // dd($formData);

        $blog = Blog::create($formData);

        // try {
        //     $categories  = $this->productCategoryService->store($formData);
        // } catch (\Exception $e) {
        //     return response()->json('Error');
        // }

        return response()->json('Blog Created Successfully');
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
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {

        $formData = $request->validated();


        $formData['updated_by_id'] = \auth::user()->id;


        if ($formData['status'] == 1) {
            $formData['status'] = true;
        }else {
            $formData['status'] = false;
        }

        if( $request->hasFile('image') ) {

            try {
                unlink(public_path( 'uploads/blog/' . $blog['image'] ));
            } catch (\Throwable $th) {

            }

            $image = Image::make($request->file('image'));

            $imageName = time().'-'.$request->file('image')->getClientOriginalName();

            $destinationPath = public_path('uploads/blog/');

            $image->save($destinationPath.$imageName);

            $formData['image'] = $imageName;
        }

        $blog->update( $formData );

        return response()->json('Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->status = 0;
        $blog->save();
        $blog->delete();

        return response()->json('Blog deleted successfully');
    }


   /**
     * Active the specified resource from storage.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function active(Blog $blog)
    {
        $blog->status = 1;
        $blog->save();
        return response()->json('Blog Activated Successfully');
    }


    /**
     * De-active the specified resource from storage.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function deactive(Blog $blog)
    {
        $blog->status = 0;
        $blog->save();
        return response()->json('Blog De-activated Successfully');
    }

    /**
     * Restore the soft deleted data.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */

    public function restore($blog)
    {
        Blog::where('id', $blog)->withTrashed()->restore();

        return response()->json('Blog Restored Successfully');
    }



    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\Blog $blog
    * @return \Illuminate\Http\Response
    */

    public function forceDelete($blog)
    {
        Blog::where('id', $blog)->withTrashed()->forceDelete();

        return response()->json('Blog Permanently Deleted Successfully');
    }


    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\Blog $blog
    * @return \Illuminate\Http\Response
    */

    public function destroyAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $blog = Blog::where('id', $id)->first();
            $blog->status = 0;
            $blog->save();
            $blog->delete();
        }
        return response()->json('Blog Deleted Successfully');
    }


    /**
     * Restore all the soft deleted data
    *
    * @param  \App\Models\Blog $blog
    * @return \Illuminate\Http\Response
    */

    public function restoreAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $blog = Blog::where('id', $id)->withTrashed()->restore();
        }

        return response()->json('Blog Restored Successfully');

    }


    /**
     * Permanently Delete all the soft deleted data
    *
    * @param  \App\Models\Blog $blog
    * @return \Illuminate\Http\Response
    */

    public function permanentDestroyAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $blog = Blog::where('id', $id)->withTrashed()->forceDelete();
        }

        return response()->json('Blog Permanently Deleted Successfully');

    }


    /**
     * Get all the data
    *
    * @param  \App\Models\Blog $blog
    * @return \Illuminate\Http\Response
    */

    public function getAllData(Request $request)
    {
        $allBlogCategory = Blog::count();
        // $activeCategories = ProductCategory::where('satus', '=', 1)->count();
        $data = [
            'allCategory' => $allBlogCategory,
            'allTrashCategory' => 3,
            'activeCategories' => 2,
        ];

        return $data;
    }

}

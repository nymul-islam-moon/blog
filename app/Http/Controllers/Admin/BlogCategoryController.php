<?php

namespace App\Http\Controllers\Admin;

use Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogCategory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Interface\BlogCategoryInterface;
use App\Interface\CodeGenerateInterface;


class BlogCategoryController extends Controller
{

    private $blogCategoryService;
    public $title;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Blog Categoory';
    }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
    {
        $query = BlogCategory::query();

        if ( ! empty( $request->f_soft_delete ) ) {
            $query->whereNull('deleted_at', $request->f_soft_delete == 1 ? '=' : '!=');
        }
    
        if ( ! empty( $request->f_status ) ) {
            $query->where('status', $request->f_status == 1 ? 1 : 0);
        }
    
        $categories = $query->orderByDesc('id')->get();
    
        if ( $request->ajax() ) {
            return DataTables::of( $categories )
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">';
                    $html .= '<div class="btn-group" role="group">';
                    $html .= '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                    $html .= 'Action';
                    $html .= '</button>';
                    $html .= '<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                    if ($row->deleted_at == null) {
                        $html .= '<li><a class="dropdown-item" href="'.route('blog.category.edit', $row->id).'" id="edit_btn">Edit</a></li>';
                        $html .= '<li><a class="dropdown-item" href="'.route('blog.category.destroy', $row->id).'" id="delete_btn">Delete</a></li>';
                    } else {
                        $html .= '<li><a class="dropdown-item" href="'.route('blog.category.restore', $row->id).'" id="restore_btn">Restore</a></li>';
                        $html .= '<li><a class="dropdown-item" href="'.route('blog.category.forcedelete', $row->id).'" id="force_delete_btn">Hard Delete</a></li>';
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                    $html .= '</div>';
                    return $html;
                })
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="checkbox_ids" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('created_by', function ($row) {
                    return !empty($row->created_by_id) ? User::find($row->created_by_id)->full_name : 'N/A';
                })
                ->addColumn('updated_by', function ($row) {
                    return !empty($row->updated_by_id) ? User::find($row->updated_by_id)->full_name : 'N/A';
                })
                ->editColumn('image', function ($row) {
                    return '<a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Username" data-bs-original-title="Username">'.
                           '<img src="'.asset('uploads/blog/category/'.$row->image).'" alt="" class="rounded-circle avatar-xxs"></a>';
                })
                ->editColumn('status', function ($row) {
                    $html = '<div class="form-check form-switch">'.
                            '<input class="form-check-input" href="'.route('blog.category.deactive', $row->id).'" type="checkbox" role="switch" id="deactive_btn" '.($row->status == 1 ? 'checked' : '').'>&nbsp;'.
                            '<label class="form-check-label" for="SwitchCheck4"> Active</label>'.
                            '</div>';
    
                    if ($row->status != 1) {
                        $html = '<div class="form-check form-switch">'.
                                '<input class="form-check-input" type="checkbox" href="'.route('blog.category.active', $row->id).'" role="switch" id="active_btn">&nbsp;'.
                                '<label class="form-check-label" for="SwitchCheck4"> De-active</label>'.
                                '</div>';
                    }
    
                    return $html;
                })
                ->rawColumns(['action', 'status', 'checkbox', 'image'])
                ->make(true);
        }

        $title = $this->title;
        return view('admin.category.index', compact('categories', 'title'));
    }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       $title = $this->title;
       return view( 'admin.category.create', compact( 'title' ) );
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\StoreProductCategoryRequest $request
    * @return \Illuminate\Http\Response
    */
    public function store(StoreBlogCategoryRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
    
            $formData = $request->validated();
            $formData['created_by_id'] = Auth::user()->id;
            $formData['status'] = $formData['status'] == 1;
    
            if ($request->hasFile('image')) {
                $image = Image::make($request->file('image'));
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('uploads/blog/category/');
                $image->save($destinationPath . $imageName);
                $formData['image'] = $imageName;
            }
    
            $blogCategory = BlogCategory::create($formData);
    
            DB::commit();
    
            return response()->json('Blog Category Created Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating the Blog Category.']);
        }
    }
    
   /**
    * Display the specified resource.
    *
    * @param  \App\Models\ProductCategory $productCategory
    * @return \Illuminate\Http\Response
    */
   public function show(BlogCategory $productCategory)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\ProductCategory  $productCategory
    * @return \Illuminate\Http\Response
    */
   public function edit(BlogCategory $blogCategory)
   {
        $title = $this->title;
        return view('admin.category.edit', compact('blogCategory', 'title'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\UpdateBlogCategoryRequest  $request
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): JsonResponse
    {
        try {
            $formData = $request->validated();
    
            $formData['updated_by_id'] = Auth::user()->id;
    
            $formData['status'] = $formData['status'] == 1;
    
            if ($request->hasFile('image')) {
                // Delete the old image file
                try {
                    unlink(public_path('uploads/blog/category/' . $blogCategory->image));
                } catch (\Throwable $th) {
                    // Handle exception if the file cannot be deleted
                }
    
                // Save the new image file
                $image = Image::make($request->file('image'));
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('uploads/blog/category/');
                $image->save($destinationPath . $imageName);
    
                $formData['image'] = $imageName;
            }
    
            $blogCategory->update($formData);
    
            return response()->json('Blog Category Updated Successfully');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the Blog Category.']);
        }
    }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */
    public function destroy(BlogCategory $blogCategory): JsonResponse
    {
        try {
            $blogCategory->update(['status' => 0]);
            $blogCategory->delete();
    
            return response()->json('Blog category deleted successfully');
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Blog Category.']);
        }
    }


   /**
     * Active the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function active(BlogCategory $blogCategory)
    {
        $blogCategory->status = 1;
        $blogCategory->save();
        return response()->json('Blog Category Activated Successfully');
    }


    /**
     * De-active the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function deactive(BlogCategory $blogCategory)
    {
        $blogCategory->status = 0;
        $blogCategory->save();
        return response()->json('Blog Category De-activated Successfully');
    }

    /**
     * Restore the soft deleted data.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */

    public function restore($blogCategory)
    {
        BlogCategory::where('id', $blogCategory)->withTrashed()->restore();

        return response()->json('Blog Category Restored Successfully');
    }



    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */

    public function forceDelete($blogCategory)
    {
        BlogCategory::where('id', $blogCategory)->withTrashed()->forceDelete();

        return response()->json('Blog Category Permanently Deleted Successfully');
    }


    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */

    public function destroyAll(Request $request): JsonResponse
    {
        try {
            $ids = $request->ids;
            $idArr = is_array($ids) ? $ids : [$ids];
    
            BlogCategory::whereIn('id', $idArr)->update(['status' => 0]);
            BlogCategory::whereIn('id', $idArr)->delete();
    
            return response()->json('Blog Categories deleted successfully');
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting Blog Categories.']);
        }
    }


    /**
     * Restore all the soft deleted data
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */

    public function restoreAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $blogCategory = BlogCategory::where('id', $id)->withTrashed()->restore();
        }

        return response()->json('Blog Category Restored Successfully');

    }


    /**
     * Permanently Delete all the soft deleted data
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */

    public function permanentDestroyAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $blogCategory = BlogCategory::where('id', $id)->withTrashed()->forceDelete();
        }

        return response()->json('Blog Category Permanently Deleted Successfully');

    }


    /**
     * Get all the data
    *
    * @param  \App\Models\BlogCategory $blogCategory
    * @return \Illuminate\Http\Response
    */

    public function getAllData(Request $request)
    {
        $allBlogCategory = BlogCategory::count();
        // $activeCategories = ProductCategory::where('satus', '=', 1)->count();
        $data = [
            'allCategory' => $allBlogCategory,
            'allTrashCategory' => 3,
            'activeCategories' => 2,
        ];

        return $data;
    }

}

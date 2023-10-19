<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Constructor Method for user controller
     */

     public function __construct() {
        $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::table('users');

        if (!empty($request->f_soft_delete)) {
            if ($request->f_soft_delete == 1) {
                $query->where('deleted_at', '=', null);
            } else {
                $query->where('deleted_at', '!=', null);
            }
        }

        if (!empty($request->f_status)) {
            if ($request->f_status == 1){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        $query->where('id', '!=', auth()->id())->get();


        $users = $query->orderByDesc('id')->get();

        if ($request->ajax()) {
            return DataTables::of($users)
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
                        $html .='<li><a class="dropdown-item" href="'. route('admin.user.edit', $row->id) .'" id="edit_btn">Edit</a></li>';
                        $html .='<li><a class="dropdown-item" href="'. route('admin.user.destroy', $row->id) .'" id="delete_btn">Delete</a></li>';
                    } else {
                        $html .='<li><a class="dropdown-item" href="'. route('admin.user.restore', $row->id) .'" id="restore_btn">Restore</a></li>';
                        $html .='<li><a class="dropdown-item" href="'. route('admin.user.forcedelete', $row->id) .'" id="force_delete_btn">Hard Delete</a></li>';
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
                ->editColumn('status', function ($row) {
                    $html = '';
                    if ($row->status == 0) {

                        $html .='<div class="form-check form-switch">';
                        $html .='<input class="form-check-input" href="'. route('admin.user.active', $row->id) .'" type="checkbox" role="switch" id="deactive_btn" checked="">&nbsp;';
                        $html .='<label class="form-check-label" for="SwitchCheck4"> Active</label>';
                        $html .='</div>';

                    } else {
                        $html .='<div class="form-check form-switch">';
                        $html .='<input class="form-check-input" type="checkbox" href="'. route('admin.user.deactive', $row->id) .'" role="switch" id="active_btn">&nbsp;';
                        $html .='<label class="form-check-label" for="SwitchCheck4"> Block</label>';
                        $html .='</div>';
                    }
                    return $html;
                })
                ->rawColumns(['action', 'status', 'checkbox'])
                ->make(true);
        }


        // $total_category =

        return view('admin.user.index');
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $formData = $request->validated();

        if ( $formData['status'] == 1 ) {
            $formData['status'] = true;
        }else {
            $formData['status'] = false;
        }

        if ( $formData['is_admin'] == 1 ) {
            $formData['is_admin'] = true;
        }else {
            $formData['is_admin'] = false;
        }

        if ( $formData['gender'] == 1 ) {
            $formData['gender'] = true;
        }else {
            $formData['gender'] = false;
        }

        if( $request->hasFile('image') ) {
            $image = Image::make( $request->file('image') );

            $imageName = time().'-'.$request->file('image')->getClientOriginalName();

            $destinationPath = public_path('uploads/user/');

            $image->save($destinationPath.$imageName);

            $formData['image'] = $imageName;
        }

        $formData['password'] = Hash::make('admin@123');

        $user = User::create($formData);

        return response()->json('User Created Successfully');
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
    public function edit( User $user )
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $formData = $request->validated();

        if ( $formData['status'] == 1 ) {
            $formData['status'] = true;
        }else {
            $formData['status'] = false;
        }

        if ( $formData['is_admin'] == 1 ) {
            $formData['is_admin'] = true;
        }else {
            $formData['is_admin'] = false;
        }

        if ( $formData['gender'] == 1 ) {
            $formData['gender'] = true;
        }else {
            $formData['gender'] = false;
        }

        if( $request->hasFile('image') ) {

            try {
                unlink(public_path( 'uploads/user/' . $user['image'] ));
            } catch (\Throwable $th) {

            }

            $image = Image::make( $request->file('image') );

            $imageName = time().'-'.$request->file('image')->getClientOriginalName();

            $destinationPath = public_path('uploads/user/');

            $image->save($destinationPath.$imageName);

            $formData['image'] = $imageName;
        }

        $formData['password'] = Hash::make('admin@123');

        $user->update($formData);

        return response()->json('User Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = 0;
        $user->save();
        $user->delete();

        return response()->json('User deleted successfully');
    }


   /**
     * Active the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function active(User $user)
    {
        $user->status = 1;
        $user->save();
        return response()->json('User Activated Successfully');
    }


    /**
     * De-active the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function deactive(User $user)
    {
        $user->status = 0;
        $user->save();
        return response()->json('User De-activated Successfully');
    }

    /**
     * Restore the soft deleted data.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function restore($user)
    {
        User::where('id', $user)->withTrashed()->restore();

        return response()->json('User Restored Successfully');
    }



    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\User $user
    * @return \Illuminate\Http\Response
    */

    public function forceDelete($user)
    {
        User::where('id', $user)->withTrashed()->forceDelete();

        return response()->json('User Permanently Deleted Successfully');
    }


    /**
     * Force Delete the soft deleted data.
    *
    * @param  \App\Models\User $user
    * @return \Illuminate\Http\Response
    */

    public function destroyAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $user = User::where('id', $id)->first();
            $user->status = 0;
            $user->save();
            $user->delete();
        }
        return response()->json('User Deleted Successfully');
    }


    /**
     * Restore all the soft deleted data
    *
    * @param  \App\Models\User $user
    * @return \Illuminate\Http\Response
    */

    public function restoreAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $user = User::where('id', $id)->withTrashed()->restore();
        }

        return response()->json('User Restored Successfully');

    }


    /**
     * Permanently Delete all the soft deleted data
    *
    * @param  \App\Models\User $user
    * @return \Illuminate\Http\Response
    */

    public function permanentDestroyAll(Request $request)
    {

        $ids = $request->ids;

        $idArr = (array) $ids;

        foreach ($idArr as $key=> $id) {
            $user = User::where('id', $id)->withTrashed()->forceDelete();
        }

        return response()->json('User Permanently Deleted Successfully');

    }

}

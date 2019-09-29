<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 5;
    private $search = ['name', 'email'];
    private $model;
    private $modelRole;

    public function __construct(UserRepositoryInterface $model, RoleRepositoryInterface $modelRole){
        $this->model = $model;
        $this->modelRole = $modelRole;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('list-user');

        if(Gate::denies('list-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }


        $columnList = ['id' => '#', 'name' => trans('my.name'), 'email' => trans('my.email')];    
        $search = "";
        if(isset($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search, $search, 'id', 'DESC');
        } else {
            $list = $this->model->paginate($this->paginate, 'id', 'DESC');
        }  

        $page = trans('my.users');
        $routeName = $this->route;

        $breadcrumb = [
            (object)['url'=>route('home'), 'title'=>trans('my.home')],
            (object)['url'=>'', 'title'=>trans('my.list',['page'=>$page])]
        ];

        return view('admin.'.$routeName.'.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $this->authorize('create-user');

        if(Gate::denies('create-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;
        $page = trans('my.users');
        $page_add = trans('my.user');

        $roles = $this->modelRole->all();

        $breadcrumb = [
            (object)['url'=>route('home'), 'title'=>trans('my.home')],
            (object)['url'=>route($routeName.'.index'), 'title'=>trans('my.list',['page'=>$page])],
            (object)['url'=>'', 'title'=>trans('my.add_user', ['page'=>$page_add])]
        ];

        return view('admin.'.$routeName.'.create', compact( 'page', 'page_add', 'routeName', 'breadcrumb', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->authorize('create-user');

        if(Gate::denies('create-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();
        
        if($this->model->create($data)){
            $request->session()->flash('msg', trans('my.registration_successfully_added'));
            $request->session()->flash('status', 'success');
            return redirect()->back();
        }else{
            $request->session()->flash('msg', trans('my.error_adding_record'));
            $request->session()->flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        if(Gate::denies('show-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;

        $register = $this->model->find($id);
        if($register){
            $page = trans('my.users');
            $page_edit = trans('my.user');
    
            $breadcrumb = [
                (object)['url'=>route('home'), 'title'=>trans('my.home')],
                (object)['url'=>route($routeName.'.index'), 'title'=>trans('my.list',['page'=>$page])],
                (object)['url'=>'', 'title'=>trans('my.show_user', ['page'=>$page_edit])]
            ];

            $delete = false;
            if($request->delete ?? false){
                $request->session()->flash('msg', trans('my.confirm_operation'));
                $request->session()->flash('status', 'error');
                $delete = true;
            }
    
            return view('admin.'.$routeName.'.show', compact('register', 'page', 'page_edit', 'routeName', 'breadcrumb', 'delete'));
        }

        return redirect()->route($routeName.'.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(Gate::denies('edit-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route;

        $register = $this->model->find($id);
        if($register){
            $page = trans('my.users');
            $page_edit = trans('my.user');
            
            $roles = $this->modelRole->all();
            
            $breadcrumb = [
                (object)['url'=>route('home'), 'title'=>trans('my.home')],
                (object)['url'=>route($routeName.'.index'), 'title'=>trans('my.list',['page'=>$page])],
                (object)['url'=>'', 'title'=>trans('my.edit_user', ['page'=>$page_edit])]
            ];
    
            return view('admin.'.$routeName.'.edit', compact('register', 'page', 'page_edit', 'routeName', 'breadcrumb', 'roles'));
        }

        return redirect()->route($routeName.'.index');

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

        if(Gate::denies('edit-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();

        if(!$data['password']){
            unset($data['password']);
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        if($this->model->update($data, $id)){
            $request->session()->flash('msg', trans('my.successfully_edited_record'));
            $request->session()->flash('status', 'success');
            return redirect()->back();
        }else{
            $request->session()->flash('msg', trans('my.error_editing_record'));
            $request->session()->flash('status', 'error');
            return redirect()->back();
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

        if(Gate::denies('delete-user')){
            session()->flash('msg', trans('my.denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        if($this->model->delete($id)){
            session()->flash('msg', trans('my.registration_deleted_successfully'));
            session()->flash('status', 'success');
            
        }else{
            session()->flash('msg', trans('my.error_deleting_record'));
            session()->flash('status', 'error');
            
        }
        $routeName = $this->route;
        return redirect()->route($routeName.'.index');
    }
}

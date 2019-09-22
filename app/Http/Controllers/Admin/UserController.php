<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 5;
    private $search = ['name', 'email'];
    private $model;

    public function __construct(UserRepositoryInterface $model){
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
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

        //$request->session()->flash('msg', 'Task was successful!');
        //$request->session()->flash('status', 'error');

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
        $routeName = $this->route;
        $page = trans('my.users');
        $page_add = trans('my.user');

        $breadcrumb = [
            (object)['url'=>route('home'), 'title'=>trans('my.home')],
            (object)['url'=>route($routeName.'.index'), 'title'=>trans('my.list',['page'=>$page])],
            (object)['url'=>'', 'title'=>trans('my.add_user', ['page'=>$page_add])]
        ];

        return view('admin.'.$routeName.'.create', compact( 'page', 'page_add', 'routeName', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    {
        //
    }
}

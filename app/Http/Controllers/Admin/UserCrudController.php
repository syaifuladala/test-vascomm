<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('Manajemen User', 'Manajemen User');
    }

    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('phone_number');
        $this->crud->addColumn([
            'name'  => 'active',
            'label' => 'Status',
            'type'  => 'boolean',
            'options' => [0 => 'Tidak Aktif', 1 => 'Aktif']
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');
        CRUD::field('phone_number');
    }

    protected function setupUpdateOperation()
    {
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');
        CRUD::field('phone_number');
        CRUD::field('active');
    }

    public function update(Request $request)
    {
        $this->crud->setRequest($this->passwordHandler($this->crud->getRequest()));
        return $this->traitUpdate();
    }

    public function store(Request $request)
    {
        if (empty($request->input('password')) || $request->input('password') == null) {
            return redirect()->back()->withErrors('Password must be required')->withInput();
        }

        $this->crud->setRequest($this->passwordHandler($this->crud->getRequest()));
        return $this->traitStore();
    }

    public function passwordHandler($request)
    {
        if(! empty($request->input('password')) || $request->input('password') != null) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }
    }
}

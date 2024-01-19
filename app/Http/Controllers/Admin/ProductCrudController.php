<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('Manajemen Product', 'Manajemen Product');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'      => 'image',
            'label'     => '',
            'type'      => 'image',
            // 'prefix' => 'folder/subfolder/',
            // 'disk'   => 'disk-name',
        ]);
        CRUD::column('name');
        CRUD::column('created_at');
        CRUD::column('price')->prefix('Rp. ');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::field('name');
        CRUD::field('price');
        $this->crud->addField([
            'name'  => 'image',
            'type'  => 'custom_html',
            'value' => '<label>Choose Image :</label><br>
            <input type="file" name="image" accept="image/png, image/jpeg" />'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function update(Request $request)
    {
        $this->crud->setRequest($this->imageHandler($this->crud->getRequest()));
        return $this->traitUpdate();
    }

    public function store(Request $request)
    {
        $this->crud->setRequest($this->imageHandler($request));
        return $this->traitStore();
    }

    public function imageHandler($request)
    {
        try {
            // if ($request->request->hasFile('image')) {

            // } else {
            //     $request->request->remove('image');
            // }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

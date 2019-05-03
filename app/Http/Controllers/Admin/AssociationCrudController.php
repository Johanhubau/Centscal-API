<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AssociationRequest as StoreRequest;
use App\Http\Requests\AssociationRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class AssociationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AssociationCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Association');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/association');
        $this->crud->setEntityNameStrings('association', 'associations');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();

        $this->crud->addColumns([

            [ // Text
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ],
            [ // Text
                'name' => 'color',
                'label' => "Color",
                'type' => 'text',
            ],
            [
                // 1-n relationship
                'label' => "President", // Table column heading
                'type' => "select",
                'name' => 'user_id', // the column that contains the ID of that connected entity;
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "App\User", // foreign key model
            ],

        ]);

        $this->crud->addFields([
            [ // Text
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ],
            [   // color_picker
                'label' => 'Association Color',
                'name' => 'color',
                'type' => 'color_picker',
                //'color_picker_options' => ['customClass' => 'custom-class']
            ],
            [  // Select
            'label' => "President",
            'type' => 'select2',
            'name' => 'user_id', // the db column for the foreign key
            'entity' => 'user', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\User",
            ]
        ]);

            // add asterisk for fields that are required in AssociationRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}

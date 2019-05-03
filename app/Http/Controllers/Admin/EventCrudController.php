<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventRequest as StoreRequest;
use App\Http\Requests\EventRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings('event', 'events');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();

        $this->crud->addColumns([

            [ // Text
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
            ],
            [
                // 1-n relationship
                'label' => "Association", // Table column heading
                'type' => "select",
                'name' => 'asso_id', // the column that contains the ID of that connected entity;
                'entity' => 'association', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "App\Models\Association", // foreign key model
            ],
            [ // Datetime
                'name' => 'start',
                'label' => "Start",
                'type' => 'datetime',
            ],
            [ // Datetime
                'name' => 'end',
                'label' => "end",
                'type' => 'datetime',
            ],
            [ // Url
                'name' => 'url',
                'label' => "Url",
                'type' => 'url',
            ],
            [ // Check
                'name' => 'all_day',
                'label' => "All day",
                'type' => 'check',
            ],
            [
                // 1-n relationship
                'label' => "Source", // Table column heading
                'type' => "select",
                'name' => 'source', // the column that contains the ID of that connected entity;
                'entity' => 'source', // the method that defines the relationship in your Model
                'attribute' => "title", // foreign key attribute that is shown to user
                'model' => "App\Models\Event", // foreign key model
            ],


        ]);

        $this->crud->addFields([
            [ // Text
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
            ],
            [  // Select
                'label' => "Association",
                'type' => 'select2',
                'name' => 'asso_id', // the db column for the foreign key
                'entity' => 'association', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\Association",
            ],
            [   // Datetime Picker
                'label' => 'Start',
                'name' => 'start',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'en'
                ],
            ],
            [   // Datetime Picker
                'label' => 'End',
                'name' => 'end',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'en'
                ],
            ],
            [ // Url
                'name' => 'url',
                'label' => "Url",
                'type' => 'url',
            ],
            [ // Check
                'name' => 'all_day',
                'label' => "All day",
                'type' => 'checkbox',
            ],
            [
                // 1-n relationship
                'label' => "Source", // Table column heading
                'type' => "select2",
                'name' => 'source', // the column that contains the ID of that connected entity;
                'entity' => 'source', // the method that defines the relationship in your Model
                'attribute' => "title", // foreign key attribute that is shown to user
                'model' => "App\Models\Event", // foreign key model
            ],

        ]);

        // add asterisk for fields that are required in EventRequest
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

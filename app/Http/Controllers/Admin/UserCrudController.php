<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('phone');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::field('name')->validationRules('required|min:5');
        CRUD::field('phone')->validationRules('required|min:11|unique:users,phone')->hint('Type a phone number without the leading zero (eg. 7034567890)');;
        CRUD::field('email')->validationRules('required|email|unique:users,email');
        CRUD::field('password')->validationRules('required');

        User::creating(function ($entry) {
            $entry->password = \Hash::make($entry->password);
      

            

$phone = $entry->phone;

$validator = Validator::make(
    ['phone' => $phone],
    ['phone' => ['required', 'regex:/^0\d+$/']]
);

        if ($validator->fails()) {
    // Validation failed
    $errors = $validator->errors();
    // Handle the validation errors
        } else {
    // Validation passed
    $phone = ltrim($phone, '0');
    // Use the stripped phone number
   
    }

});  

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::field('name')->validationRules('required|min:5');
        CRUD::field('phone')->validationRules('required|min:11|unique:users,phone')->hint('Type a phone number without the leading zero (eg. 7034567890).');
          CRUD::field('email')->validationRules('required|email|unique:users,email,'.CRUD::getCurrentEntryId());
          CRUD::field('password')->hint('Type a password to change it.');

          User::updating(function ($entry) {
              if (request('password') == null) {
                  $entry->password = $entry->getOriginal('password');
              } else {
                  $entry->password = \Hash::make(request('password'));
              }
          });
    }
}

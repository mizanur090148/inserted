<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ApiCrudHandler
{
    /**    
     * @param String $modelClassName
     * @param Request $request
     *
     * @return Array
     */
    public function index(Request $request, $modelClassName, $with = '')
    {
        // Load model class object
        $modelData = new $modelClassName();
        // Eager load data
        if (count($with)) {
            $modelData = $modelData->with($with);
        }
        // For order by
        if ($request->has('sortByColumn') && $request->has('sortBy')) {
            $modelData = $modelData->orderBy($request->sortByColumn, $request->sortBy);
        } else {
            $modelData = $modelData->latest();
        }
        return $modelData->paginate();
    }

    /**    
     * @param Request $request
     * @param String $moduleName
     * @param String $modelClassName
     * @param Array $arrFieldsToSave
     *
     * @return Array
     */
    public function store(Request $request, $modelClassName)
    {
        $obj = $modelClassName::create($request->all());
        return $obj;
    }

    /**     
     * @param Request $request
     * @param String $moduleName
     * @param String $modelClassName
     * @param Array $arrFieldsToSave
     *
     * @return Array
     */
    public function update(Request $request, $modelClassName)
    { 
        $obj = $modelClassName::find($request->id);     
        $obj->fill($request->all());
        $obj->save();

        return $obj;
    }   

    /**    
     * @param String $modelClassName
     * @param String $id
     *
     * @return Boolean
     */
    public function delete($id, $modelClassName)
    {
        //Load selected model
        $deleteData = $modelClassName::find($id);     
        return $deleteData->delete();
    }    
}

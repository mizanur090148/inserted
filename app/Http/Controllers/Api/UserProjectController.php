<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\ApiCrudHandler;
use App\Http\Requests\UserProjectRequest;
use App\UserProject;
use Validator;

class UserProjectController extends BaseController
{
    protected $apiCrudHandler;

	public function __construct()
    {
        $this->apiCrudHandler = new ApiCrudHandler();
    }

    public function index(Request $request)
    {
        try {
            $with = ['user','project'];
        	$modelData = $this->apiCrudHandler->index($request, UserProject::class, $with);
        	return $this->sendResponse($modelData);
        } catch (Exception $e) {
        	return $this->sendError($e->getMessage());
        }        
    }

    /**
    *
     * @param Request $request
     * @param String $moduleName
     * @param String $modelClassName   
     *
     * @return Array
     */
    public function store(UserProjectRequest $request)
    {
        //If ID then update, else create
        try {           
        	$modelData = $this->apiCrudHandler->store($request, UserProject::class);
            // lazy load
            $modelData = $modelData->load('user', 'project');
        	return $this->sendResponse($modelData);
        } catch (Exception $ex) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
    *
     * @param Request $request
     * @param String $moduleName
     * @param String $modelClassName   
     *
     * @return Array
     */
    public function update($id, UserProjectRequest $request)
    {
    	//If ID then update, else create
        try {           
        	$modelData = $this->apiCrudHandler->update($request, UserProject::class);
        	return $this->sendResponse($modelData);       
        } catch (Exception $ex) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
        	$delete = $this->apiCrudHandler->delete($id, UserProject::class);
        	return $this->sendResponse($delete);
        } catch (Exception $e) {
        	return $this->sendError($e->getMessage());
        }  
    }
}

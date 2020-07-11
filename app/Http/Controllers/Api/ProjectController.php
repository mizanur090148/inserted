<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\ApiCrudHandler;
use App\Http\Requests\ProjectRequest;
use App\Project;
use Validator;

class ProjectController extends BaseController
{
    protected $apiCrudHandler;

	public function __construct()
    {
        $this->apiCrudHandler = new ApiCrudHandler();
    }

    public function index(Request $request)
    {
        try {
        	$modelData = $this->apiCrudHandler->index($request, Project::class, $with = []);
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
    public function store(ProjectRequest $request)
    {       
        try {           
        	$modelData = $this->apiCrudHandler->store($request, Project::class);           
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
    public function update($id, ProjectRequest $request, Project $project)
    {
    	//If ID then update, else create
        try {
            $this->authorize('update', $project);
            $request->request->add(['id' => $id]);
        	$modelData = $this->apiCrudHandler->update($request, Project::class);
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
    public function delete($id, Project $project)
    {
        try {
            $this->authorize('delete', $project);
        	$delete = $this->apiCrudHandler->delete($id, Project::class);
        	return $this->sendResponse($delete);
        } catch (Exception $e) {
        	return $this->sendError($e->getMessage());
        }  
    }
}

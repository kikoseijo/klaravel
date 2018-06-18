<?php

namespace Ksoft\Klaravel\Routing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ksoft\Klaravel\Traits\CallsInteractions;

class KrudPolicyController extends Controller
{
    use CallsInteractions;

    protected $repo;
    protected $path;
    protected $createInteraction;
    protected $updateInteraction;

    public function index(Request $request)
    {
        $perPageKey = config('ksoft.CONSTANTS.take', 'PER_PAGE');
        $perPage = $request->take ?? session($perPageKey, 10);
        $records = $this->repo->withPagination($perPage, $request);

        $res = array_merge($this->loadCrudStyles(), [
            'records' => $records,
            'model_name' => $this->path,
        ]);

        return $this->returnCustomView($res);
    }

    public function create()
    {
        $this->authorize('create', $this->repo->model());
        $res = array_merge($this->loadCrudStyles(), ['model_name' => $this->path]);

        return $this->returnCustomView($res, 'create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->repo->model());
        $record = $this->interaction($this->createInteraction, [$request->all()]);

        return redirect(route($this->path . '.index'))->with('flash_message', 'Record added succesfully');
    }

    public function show($id)
    {
        return redirect(route($this->path . '.index'));
    }

    public function edit($id)
    {
        $record = $this->repo->find($id);
        $this->authorize('update', $record);
        $res = array_merge($this->loadCrudStyles(), [
            'record' => $record,
            'model_name' => $this->path,
        ]);

        return $this->returnCustomView($res, 'edit');
    }

    public function update(Request $request, $id)
    {
        $record = $this->repo->find($id);
        $this->authorize('update', $record);
        $updatedRecord = $this->interaction($this->updateInteraction, [$record->id, $request->all()]);

        return redirect(route($this->path . '.index'))->with('flash_message', 'Record updated succesfully');
    }

    public function destroy($id)
    {
        $record = $this->repo->find($id);
        $this->authorize('delete', $record);
        $record->delete();

        return redirect(route($this->path . '.index'))->with('flash_message', 'Record deleted succesfully');
    }

    protected function loadCrudStyles()
    {
        $viewsBasePath = config('ksoft.module.crud.views_base_path', '');
        $crudWrapperClass = config('ksoft.style.crud_container_wrapper', 'container -body-block pb-5');

        return [
            'viewsBasePath' => $viewsBasePath,
            'crudWrapperClass' => $crudWrapperClass,
        ];
    }

    protected function returnCustomView($data, $key = 'index')
    {
        $view = $data['viewsBasePath'] . $data['model_name'] . '.' . $key;

        return view()->exists($view)
        ? view($view, $data)
        : view('klaravel::crud.' . $key, $data);

    }

}

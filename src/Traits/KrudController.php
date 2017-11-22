<?php

namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;
use Ksoft\Klaravel\Larapp;

trait KrudController
{

    /**
     * Execute the given interaction.
     *
     * This performs the common validate and handle methods for common interactions.
     *
     * @param  string  $interaction
     * @param  array  $parameters
     * @return mixed
     */
    protected function interaction($interaction, array $parameters)
    {
        Larapp::interact($interaction.'@validator', $parameters)->validate();

        return Larapp::interact($interaction, $parameters);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->has('name') ? $request->input('name') : '';
        return $this->repo->withRelationships($request->input('pageSize'), $query);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = str_replace('*', '%', $request->input('query'));

        return $this->repo->findWhereLike('name', '%'.$query.'%', 10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->interaction($this->createInteraction, [$request->all()]);
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
        return $this->interaction($this->updateInteraction, [$id, $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
    }
}

<?php

namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;

/**
 * Crud controller functions using interactions
 *
 * Use this trait to handle all APIResource routes and work on Interacions only.
 */
trait KrudControllerTrait
{

  /**
   * Display a listing of the records.
   * GET|HEAD /records
   *
   * @param Request $request
   * @return Response
   */
  public function index(Request $request)
  {
      return $this->repo->withRelationships($request);
  }

  /**
   * @param Request $request
   * @return mixed
   */
  public function search(Request $request)
  {
      $query = str_replace('*', '%', $request->input('q'));

      return $this->repo->findWhereLike('name', '%'.$query.'%', 10);
  }

  /**
   * Store a newly created record in storage.
   * POST /records
   *
   * @param Illuminate\Http\Request $request
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $record = $this->interaction($this->createInteraction, [$request->all()]);
      return $this->createdResponse($record);
  }

  /**
   * Update the specified record in storage.
   * PUT/PATCH /records/{id}
   *
   * @param  int $id
   * @param Illuminate\Http\Request $request
   *
   * @return Response
   */
  public function update(Request $request, $id)
  {
      $record = $this->interaction($this->updateInteraction, [$id, $request->all()]);
      return $this->successResponse($record);
  }

  /**
   * Remove the specified record from storage.
   * DELETE /records/{id}
   *
   * @param  int $id
   *
   * @return Response
   */
  public function destroy($id)
  {
      $this->repo->delete($id);
  }

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
      $this->call($interaction.'@validator', $parameters)->validate();

      return $this->call($interaction, $parameters);
  }

  /**
   * Will call interacion handle function if no other method its defined.
   *
   * @param  string $interaction
   * @param  array  $parameters
   * @return mixed
   */
  protected function call($interaction, array $parameters = [])
  {
      if (!str_contains($interaction, '@')) {
          $interaction = $interaction.'@handle';
      }

      list($class, $method) = explode('@', $interaction);

      $base = class_basename($class);

      return call_user_func_array([app($class), $method], $parameters);
  }

  abstract protected function successResponse($data);
  abstract protected function createdResponse($data);

}

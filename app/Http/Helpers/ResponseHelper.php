<?php
namespace App\Http\Helpers;

class ResponseHelper {

	public function SHOW($data)
	{
		return response()->json($data, 200);
	}

	public function CREATED($data)
	{
		return response()->json($data, 201);
	}

	public function NO_CONTENT()
	{
		return response()->json([
			"message" => "",
			"status"  => 204
		], 204);
	}

	public function PARTIAL_CONTENT($list)
	{
		return response()->json($list, 206);
	}

	public function BAD_REQUEST($errors)
	{
		return response()->json([
			"message" => "invalid parameters",
			"error"   => "BAD_REQUEST",
			"status"  => 400,
			"cause"   => $errors
		], 400);
	}

	public function FORBIDDEN()
	{
		return response()->json([
			"message" => "Sin permisos para realizar esta accion.",
			"error"   => "forbidden",
			"status"  => 403,
		], 403);
	}

	public function NOT_FOUND($elemento)
	{
		return response()->json([
			"message" => $elemento . " not found",
			"error"   => "not_found",
			"status"  => 404,
		], 404);
	}
}

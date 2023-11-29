<?php

namespace Codelab\Traits;

trait ApiResponseFormatter
{
  public function apiResponse($code = 200, $message = "successd", $data = [])
  {
    return json_encode([
      "code" => $code,
      "message" => $message,
      "data" => $data
    ]);
  }
}

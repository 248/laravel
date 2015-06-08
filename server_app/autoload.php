<?php
spl_autoload_register(function($name){
  static $classmap;
  if (!$classmap) {
    $classmap = array(
      'proto\Request' => '/proto/Request.php',
      'proto\Request\NetworkTestRequest' => '/proto/Request/NetworkTestRequest.php',
      'proto\Request\DailySettingInfoRequest' => '/proto/Request/DailySettingInfoRequest.php',
      'proto\Request\GameLogRequest' => '/proto/Request/GameLogRequest.php',
      'proto\Response' => '/proto/Response.php',
      'proto\Response\NetworkTestResponse' => '/proto/Response/NetworkTestResponse.php',
      'proto\Response\DailySettingInfoResponse' => '/proto/Response/DailySettingInfoResponse.php',
      'proto\Response\GameLogResponse' => '/proto/Response/GameLogResponse.php',
      // @@protoc_insertion_point(autoloader_scope:classmap)
    );
  }
  if (isset($classmap[$name])) {
    require __DIR__ . DIRECTORY_SEPARATOR . $classmap[$name];
  }
});

call_user_func(function(){
  $registry = \ProtocolBuffers\ExtensionRegistry::getInstance();
  // @@protoc_insertion_point(extension_scope:registry)
});

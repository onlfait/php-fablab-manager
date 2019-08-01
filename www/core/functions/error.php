<?php
function bufferClean () {
  if (ob_get_level()) ob_end_clean();
  ob_start();
}

function errorTrace () {
  ob_start();
  debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
  $trace = ob_get_contents();
  ob_end_clean();
  return $trace;
}

function exceptionToArray ($exception) {
  return [
    'type' => $exception->getCode(),
    'message' => $exception->getMessage(),
    'file' => $exception->getFile(),
    'line' => $exception->getLine(),
    'trace' => $exception->getTraceAsString()
  ];
}

function errorToString (array $error) {
  extract($error);
  $string = vsprintf('<h4>%s</h4><p>%s:%u</p>', [$message, $file, $line]);
  if ($trace) {
    $string .= vsprintf('<pre>%s</pre>', [$trace]);
  }
  return str_replace(PFM_ROOT_PATH, '', $string);
}

function errorPrint (array $error) {
  try {
    bufferClean();
    $title = text('Error', null, 'core') . ' 500';
    $message = stateGet('debug') ? errorToString($error) : null;
    stateSet('error.title', $title);
    stateSet('error.message', $message);
    routerDispatch(['page' => 'errors', 'action' => '500']);
    exit($error['type']);
  } catch (Exception $exception) {
    bufferClean();
    echo('<!DOCTYPE html><html>');
    echo('<head><meta charset="utf-8"><title>' . $title . '</title></head>');
    echo('<body><h1>' . $title . '</h1>');
    if (stateGet('debug')) {
      echo('<hr/>');
      echo('<pre>' . errorToString(exceptionToArray($exception)) . '</pre>');
    }
    echo('</body></html>');
    exit($exception->getCode());
  }
}

function errorHandler (int $type, string $message, string $file, int $line) {
  $trace = errorTrace();
  errorPrint(compact('type', 'message', 'file', 'line', 'trace'));
  return true;
}

function exceptionHandler ($exception) {
  errorPrint(exceptionToArray($exception));
}

function fatalErrorHandler () {
  $error = error_get_last();
  if ($error) {
    $error['trace'] = errorTrace();
    errorPrint($error);
  }
}

function errorHandlerRegister () {
  error_reporting(E_ALL);
  set_error_handler('errorHandler');
  set_exception_handler('exceptionHandler');
  register_shutdown_function('fatalErrorHandler');
}

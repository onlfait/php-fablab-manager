<?php namespace PFM;

abstract class Controller {
  abstract public function dispatch(array $args = null): void;
}

<?php
use enterprices\Router;

// user regexp ???????
Router::add('/^(?P<controller>bus)\/(?P<action>route)\/(?P<select>[0-9a-z-]+)?$/iu');
Router::add('/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)\/(?P<modificator>[0-9a-z-]+)?$/iu');
// default routes
Router::add('/^$/iu', ['controller' => 'Main', 'action' => 'index']);
Router::add('/^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$/iu');
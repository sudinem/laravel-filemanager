<?php namespace Unisharp\Laravelfilemanager\controllers;

use Illuminate\Foundation\Bus\DispatchesCommands as DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
}

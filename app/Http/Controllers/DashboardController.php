<?php

namespace App\Http\Controllers;

use App\Actions\PrepareDashboardView;

class DashboardController
{
    public function index(PrepareDashboardView $action)
    {
        return $action->handle();
    }
}

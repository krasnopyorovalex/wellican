<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function __invoke(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.home');
    }
}

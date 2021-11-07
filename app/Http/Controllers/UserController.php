<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    private $cacheTimeout = 60; // in seconds
    private $perPage = 20; // number of items

    public function index(Request $request)
    {
        $search_year = $request->year;
        $search_month = $request->month;
        $cache_timeout = $this->cacheTimeout;
        $per_page = $request->perpage ?? $this->perPage;
        $page = $request->page ?? 1;
        $cache_key = 'user_p_'. $page;
        $query = User::query();

        if ( $search_year && $search_month ){

            $cache_key .= '_y_'. $search_year . '_and_m_' . $search_month;

            $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year, $search_month, $per_page) {
                return $query->whereYear('dob', $search_year)
                        ->whereMonth('dob', $search_month)
                        ->paginate($per_page);
            });

        } elseif ($search_year){

            $cache_key .= '_y_'. $search_year;

            $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year, $per_page) {
                return $query->whereYear('dob', $search_year)
                        ->paginate($per_page);
            });

        } elseif ($search_month){

            $cache_key .= '_m_' . $search_month;

            $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_month, $per_page) {
                return $query->whereMonth('dob', $search_month)
                        ->paginate($per_page);
            });

        } else {

            $users = Cache::remember($cache_key, $cache_timeout, function() use ($query, $per_page) {
                return $query->paginate($per_page);
            });

        }

        $paginator = $users->appends($request->except('page'));

        return View('users')->with('users', $paginator);
    }

}

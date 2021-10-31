<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search_year = $request->year;
        $search_month = $request->month;
        $cache_timeout = 60; // in seconds
        $per_page = $request->perpage ?? 20;
        $page = $request->page ?? 1;
        $cache_key = 'user_all_pp_' . $per_page.'_p_'.$page;
        $query = User::query();

        if ( $search_year && $search_month ){

            $cache_key = 'user_y_'. $search_year . '_and_m_' . $search_month . '_pp_' . $per_page.'_p_'.$page;

            $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year, $search_month, $per_page) {
                return $query->whereYear('dob', $search_year)
                        ->whereMonth('dob', $search_month)
                        ->paginate($per_page);
            });

        } elseif ( $search_year || $search_month ){

            if(!$search_month){
                $cache_key = 'user_y_'. $search_year . '_pp_' . $per_page.'_p_'.$page;

                $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year,$per_page) {
                    return $query->whereYear('dob', $search_year)
                            ->paginate($per_page);
                });
            }

            if(!$search_year){
                $cache_key = 'user_m_' . $search_month . '_pp_' . $per_page.'_p_'.$page;

                $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_month, $per_page) {
                    return $query->whereMonth('dob', $search_month)
                            ->paginate($per_page);
                });
            }

        } else {

            $users = Cache::remember($cache_key, $cache_timeout, function() use ($query, $per_page) {
                return $query->paginate($per_page);
            });

        }

        $users->appends(['year' => $search_year, 'month' => $search_month]);

        return View('users', compact('users'));
    }

}

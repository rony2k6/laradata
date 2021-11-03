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
        $cache_key = 'user_all';
        $query = User::query();

        if ( $search_year && $search_month ){

            $cache_key = 'user_y_'. $search_year . '_and_m_' . $search_month;

            $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year, $search_month) {
                return $query->whereYear('dob', $search_year)
                        ->whereMonth('dob', $search_month)
                        ->get();
            });

        } elseif ( $search_year || $search_month ){

            if(!$search_month){
                $cache_key = 'user_y_'. $search_year;

                $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_year) {
                    return $query->whereYear('dob', $search_year)
                            ->get();
                });
            }

            if(!$search_year){
                $cache_key = 'user_m_' . $search_month;

                $users = Cache::remember($cache_key, $cache_timeout, function () use ($query, $search_month) {
                    return $query->whereMonth('dob', $search_month)
                            ->get();
                });
            }

        } else {

            $users = Cache::remember($cache_key, $cache_timeout, function() use ($query) {
                return $query->get();
            });

        }

        $slice = $users->slice((($page-1) * $per_page), $per_page);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($slice, $users->count(), $per_page, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);

        return View('users')->with('users', $paginator);
    }

}

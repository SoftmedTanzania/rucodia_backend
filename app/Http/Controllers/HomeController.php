<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $totalTransactions = Transaction::count('id');
        $totalSales = Transaction::where('transactiontype_id', 2)->sum('price');
        $totalProducts = Product::count('id');
        $totalUsers = User::count('id');
        return view('dashboard')
            ->with('totalSales', $totalSales)
            ->with('totalProducts', $totalProducts)
            ->with('totalUsers', $totalUsers)
            ->with('totalTransactions', $totalTransactions);

    }

    /**
     * Show API Documentation page application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function apidocs()
    {
        return view('apidocs');
    }
}

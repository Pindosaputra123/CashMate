<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Customer::DataTable($request);
        }

        return view('customer.index',[
            'title' => 'Customer',
            'description' => 'Ini adalah page untuk mengelola data customer',
            'breadcrumbs' => [
                'title' => 'Data Customer',
                'url' => route('customer.index')
            ]
        ]);
    }

    public function store(Request $request){
        Validations::createCust($request);
        DB::beginTransaction();
        try {
            Customer::createCust($request->all());
            DB::commit();

            return Response::success([
                'message' => 'Customer Berhasil Di Tambahkan'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function get(Customer $customer){
        DB::beginTransaction();
        try {
            return Response::success([
                'customer' => $customer
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Customer $customer){
        Validations::updateCust($request, $customer);
        DB::beginTransaction();
        try {
            $customer->updateCustomer($request->all());
            DB::commit();

            return Response::success([
                'message' => 'Customer Berhasil Di update'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Response::error($e);
        }
    }

    public function destroy(Customer $customer){
        DB::beginTransaction();
        try {
            $customer->deleteCustomer();
            DB::commit();

            return Response::success([
                'message' => 'Data Berhasil Di Hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function getCust(Request $request){
        try {
            $id = $request->id;
            $customer = new Customer();

            // $customer->where('id', $request->id)->first();
            $cust = $customer->where('id', $id)->get();

            return Response::success([
                'cust' => $cust
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;

class HomeController extends Controller
{
    function generateRandomString($length = 10)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function products()
    {
        if (!session('username')) {
            return redirect('/');
        }
        $data = [
            'title' => 'Products',
            'products' => Product::all(),
        ];
        return view('products', $data);
    }

    public function product_detail($Product_Code)
    {
        if (!session('username')) {
            return redirect('/');
        }
        $data = [
            'title' => 'Product Detail',
            'product' => Product::where('Product_Code', $Product_Code)->first(),
        ];
        return view('product_detail', $data);
    }

    public function buy($id)
    {
        if (!session('username')) {
            return redirect('/');
        }
        $documentCode = $this->generateRandomString(3);
        $product = Product::find($id);
        $price = $product->Price - ($product->Price * $product->Discount / 100);
        $checkTransaction = TransactionHeader::where('User', session('username'))->first();
        if ($checkTransaction) {
            $transaction = TransactionHeader::where('User', session('username'))->first();
            $transaction->Total = $checkTransaction->Total + $price;
            $transaction->save();

            $checkTransactionDetail = TransactionDetail::where('Document_Code', $transaction->Document_Code)->where('Document_Number', $transaction->Document_Number)->where('Product_Code', $product->Product_Code)->first();
            if ($checkTransactionDetail) {
                $transactionDetail = TransactionDetail::where('id', $checkTransactionDetail->id)->first();
                $transactionDetail->Quantity = $checkTransactionDetail->Quantity + 1;
                $transactionDetail->Sub_Total = ($checkTransactionDetail->Quantity + 1) * $price;
                $transactionDetail->save();
            } else {
                $transactionDetail = new TransactionDetail();
                $transactionDetail->Document_Code = $transaction->Document_Code;
                $transactionDetail->Document_Number = $transaction->Document_Number;
                $transactionDetail->Product_Code = $product->Product_Code;
                $transactionDetail->Price = $price;
                $transactionDetail->Quantity = 1;
                $transactionDetail->Unit = $product->Unit;
                $transactionDetail->Sub_Total = $price;
                $transactionDetail->Currency = $product->Currency;
                $transactionDetail->save();
            }
        } else {
            $transaction = new TransactionHeader();
            $transaction->Document_Code = $documentCode;
            $transaction->Document_Number = str_pad(1, 3, '0', STR_PAD_LEFT);
            $transaction->User = session('username');
            $transaction->Total = $price;
            $transaction->Date = date('Y-m-d');
            $transaction->save();

            $transactionDetail = new TransactionDetail();
            $transactionDetail->Document_Code = $documentCode;
            $transactionDetail->Document_Number = str_pad(1, 3, '0', STR_PAD_LEFT);
            $transactionDetail->Product_Code = $product->Product_Code;
            $transactionDetail->Price = $price;
            $transactionDetail->Quantity = 1;
            $transactionDetail->Unit = $product->Unit;
            $transactionDetail->Sub_Total = $price;
            $transactionDetail->Currency = $product->Currency;
            $transactionDetail->save();
        }
        echo json_encode(['status' => 'success', 'message' => 'Successfully added to cart']);
    }

    public function checkout()
    {
        if (!session('username')) {
            return redirect('/');
        }
        $transactions = TransactionHeader::where('User', session('username'))->first();
        $transactionDetail = TransactionDetail::where('Document_Code', $transactions->Document_Code)->where('Document_Number', $transactions->Document_Number)->get();
        $products = [];
        foreach ($transactionDetail as $detail) {
            $products[] = Product::where('Product_Code', $detail->Product_Code)->first();
        }
        $data = [
            'title' => 'Checkout',
            'transactions' => $transactions,
            'transaction_details' => $transactionDetail,
            'products' => $products,
        ];
        return view('checkout', $data);
    }
}

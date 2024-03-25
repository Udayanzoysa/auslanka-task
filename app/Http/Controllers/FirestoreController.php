<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\FirestoreService;
use Carbon\Carbon;

class FirestoreController extends Controller
{
    protected $firestoreService;

    public function __construct(FirestoreService $firestoreService)
    {
        $this->firestoreService = $firestoreService;
    }

    public function createProduct(Request $request)
    {
        $data = $request->validate([
            'proID' => 'required|string',
            'name' => 'required|string',
            'sellingPrice' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $firestore = $this->firestoreService->getFirestore();
        $collection = $firestore->collection('products');

        $existingDoc = $collection->document($data['proID'])->snapshot();

        if ($existingDoc->exists()) {
            $collection->document($data['proID'])->set($data);
            return response()->json(['message' => 'Product updated successfully'], 200);
        } else {
            $newDocRef = $collection->document($data['proID']);
            $newDocRef->set($data);
            return response()->json(['message' => 'Product created successfully'], 201);
        }
    }

    public function deleteProduct($proID)
    {
        $firestore = $this->firestoreService->getFirestore();
        $collection = $firestore->collection('products');

        $existingDoc = $collection->document($proID)->snapshot();

        if ($existingDoc->exists()) {
            $collection->document($proID)->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function updateProduct(Request $request, $proID)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sellingPrice' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $firestore = $this->firestoreService->getFirestore();
        $collection = $firestore->collection('products');

        $existingDoc = $collection->document($proID)->snapshot();

        if ($existingDoc->exists()) {
            $collection->document($proID)->set($data, ['merge' => true]);
            return response()->json(['message' => 'Product updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function viewProduct($proID)
    {
        $firestore = $this->firestoreService->getFirestore();
        $collection = $firestore->collection('products');

        $existingDoc = $collection->document($proID)->snapshot();

        if ($existingDoc->exists()) {
            $productData = $existingDoc->data();
            return response()->json(['product' => $productData]);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function viewAllProducts()
    {
        $firestore = $this->firestoreService->getFirestore();
        $collection = $firestore->collection('products');

        $allProducts = [];
        $querySnapshot = $collection->documents();

        foreach ($querySnapshot as $document) {
            $productData = $document->data();
            $allProducts[] = $productData;
        }

        return response()->json(['products' => $allProducts]);
    }
}

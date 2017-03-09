<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        //Page de base du backend, liste des produits
        $products = Product::all();
        return view('admin.products',['products' => $products]);
    }
    public function destroy($id)
    {
        // Supprimer un produit en backend et rediriger vers
        // la liste des produits.
        Product::destroy($id);
        return redirect('/admin/products');
    }
    public function newProduct()
    {
        //vue d'ajout d'un produit
        return view('admin.new');
    }
    public function add()
    {
        $file = Request::file('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension, File::get($file));

        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
        $entry->save();

        $product = new Product();
        // On lie la table product et le file added
        $product->file_id=$entry->id;
        $product->name = Request::input('name');
        $product->description = Request::input('description');
        $product->price = Request::input('price');
        $product->imageurl= Request::input('imageurl');
        $product->save();

        return redirect('/admin/products');


    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class AdminController extends Controller
{
    public function unAuthorizedAccess(){
        return view('backend.un-authorized');
    }
    public function index(){
        return view('backend.index');
    }
    public function login(){
        return view('backend.account.login');
    }
    public function loginAuthenticate(AdminLoginRequest $request){
        $credential = $request->only('email','password');
        if (auth()->attempt($credential)){
            if (auth()->user()->role == 'admin'){
                return redirect()->route('adminDashboard');
            }
            else{
                return redirect()->route('unAuthorizedAccess');
            }
        }
        else{
            return redirect()->back()->with('error-msg','Invalid Credentials! Try Again');
        }
    }

    ///*** Category Section | Functions Starts Here  ***///
    public function viewCategories(){
        $categories = Category::all();
        return view('backend.category.view-categories',compact('categories'));
    }
    public function addCategory(Request $request){
        $save_category = Category::create([
            'name' => $request->input('name')
        ]);
        if ($save_category){
            return redirect()->back();
        }
    }
    public function getCategory($id){
        $category = Category::findOrFail($id);
        return response()->json(['status' => 'success','data'=>$category],200);
    }
    public function updateCategory(Request $request){
        $update_category = Category::findOrFail($request->input('cat_id'));
        $update_category->name = $request->input('name');
        if ($update_category->save()){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function deleteCategory($id){
        $delete_category = Category::findOrFail($id);
        $delete_category->delete();
        return redirect()->back();
    }
    ///*** Category Section | Functions Ends Here  ***///

    ///*** Collection Section | Functions Starts Here  ***///
    public function viewCollections(){
        $collections = Collection::with('category')->orderBy('category_id')->get();
        $categories = Category::all();
        return view('backend.collection.view-collections',compact('collections','categories'));
    }
    public function addCollection(Request $request){
        $save_collection = Collection::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name')
        ]);
        if ($save_collection){
            return redirect()->back();
        }
    }
    public function getCollection($id){
        $collection = Collection::findOrFail($id);
        return response()->json(['status' => 'success','data'=>$collection],200);
    }
    public function updateCollection(Request $request){
        $update_collection = Collection::findOrFail($request->input('col_id'));
        $update_collection->name = $request->input('name');
        if ($update_collection->save()){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function deleteCollection($id){
        $delete_collection = Collection::findOrFail($id);
        $delete_collection->delete();
        return redirect()->back();
    }
    ///*** Collection Section | Functions Ends Here  ***///

    ///*** Tags Section | Functions Starts Here  ***///
    public function viewTags(){
        $tags = Tag::all();
        return view('backend.tag.view-tag',compact('tags'));
    }
    public function addTag(Request $request){
        $save_tag = Tag::create([
            'name' => Str::slug($request->input('name'),'-')
        ]);
        if ($save_tag){
            return redirect()->back();
        }
    }
    public function getTag($id){
        $tag = Tag::findOrFail($id);
        return response()->json(['status' => 'success','data'=>$tag],200);
    }
    public function updateTag(Request $request){
        $update_tag = Tag::findOrFail($request->input('tag_id'));
        $update_tag->name = Str::slug($request->input('name'),'-');
        if ($update_tag->save()){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function deleteTag($id){
        $delete_tag = Tag::findOrFail($id);
        $delete_tag->delete();
        return redirect()->back();
    }
    ///*** Tags Section | Functions Ends Here  ***///

    ///*** Product Section | Functions Starts Here  ***///
    public function viewProducts(){
        $products = Product::with('medias')->orderByDesc('created_at')->get();
        return view('backend.product.view-product',compact('products'));
    }
    public function addProduct(){
        $all_categories = Category::all();
        $collections = Collection::orderBy('category_id')->get();
        $all_tags = Tag::all();
        return view('backend.product.add-product',compact('all_categories','all_tags','collections'));
    }
    public function saveProduct(SaveProductRequest $request){
        $save_prodcut = Product::create([
            'category_id' => $request->input('product_category'),
            'collection_id' => $request->input('product_collection'),
            'name' => $request->input('product_name'),
            'price' => $request->input('product_price'),
            'size' => $request->input('product_size'),
            'video' => $request->input('product_video_url'),
            'description' => $request->input('product_description'),
            'color' => $request->input('color2'),
        ]);
        if ($save_prodcut){
            $get_saved_product = Product::findOrFail($save_prodcut->id);
            $get_saved_product->slug = Str::slug($request->input('product_name'),'-').'-zk'.$get_saved_product->id;
            $get_saved_product->save();
            if ($request->input('product_tags')){
                foreach ($request->input('product_tags') as $tags){
                    $save_prodcut->tags()->attach($tags);
                }
            }
            if($request->file('images')) {
                foreach ($request->file('images') as $myfile){
                    $imageName = strtotime(now()).rand(11111,99999).'.'.$myfile->getClientOriginalExtension();
                    if(!is_dir(public_path() . '/assets/frontend/img/product')){
                        mkdir(public_path() . '/assets/frontend/img/product', 0777, true);
                    }
                    $myfile->move(public_path() . '/assets/frontend/img/product', $imageName);
                    $save_product_images = Media::create([
                        'product_id' =>  $save_prodcut->id,
                        'image' => $imageName,
                    ]);
                }
            }
            return redirect()->route('viewProducts');
        }
        else{
            return redirect()->back();
        }
    }
    public function productDetail($id){
        $product = Product::with(['medias','category','tags'])->findOrFail($id);
        return view('backend.product.product-detail',compact('product'));
    }
    public function getProductImage($id){
        $product_image = Media::findOrFail($id);
        return response()->json(['status' => 'success','data'=>$product_image],200);
    }
    public function updateProductImage(Request $request){
        if($request->file('product_image')) {
            $myfile = $request->file('product_image');
            $imageName = strtotime(now()).rand(11111,99999).'.'.$myfile->getClientOriginalExtension();
            if(!is_dir(public_path() . '/assets/frontend/img/product')){
                mkdir(public_path() . '/assets/frontend/img/product', 0777, true);
            }
            $myfile->move(public_path() . '/assets/frontend/img/product', $imageName);
            $save_product_images = Media::findOrFail($request->input('product_image_id'));
            $save_product_images->image = $imageName;
            if ($save_product_images->save()){
                return redirect()->back();
            }
        }
    }
    public function removeProductImage($id){
        $image = Media::findOrFail($id);
        $image->delete();
        return redirect()->back();
    }
    public function addMoreProductImage(Request $request){
        if($request->file('images')) {
            foreach ($request->file('images') as $myfile){
                $imageName = strtotime(now()).rand(11111,99999).'.'.$myfile->getClientOriginalExtension();
                if(!is_dir(public_path() . '/assets/frontend/img/product')){
                    mkdir(public_path() . '/assets/frontend/img/product', 0777, true);
                }
                $myfile->move(public_path() . '/assets/frontend/img/product', $imageName);
                $save_product_images = Media::create([
                    'product_id' =>  $request->input('product_id'),
                    'image' => $imageName,
                ]);
            }
            return redirect()->back();
        }
    }
    public function updateProductForm($id){
        $product = Product::with('category')->findOrFail($id);
        $all_categories = Category::all();
        $all_tags = Tag::all();
        return view('backend.product.update-product',compact('product','all_categories','all_tags'));
    }
    public function updateProduct(SaveProductRequest $request){
        $product = Product::findOrFail($request->input('product_id'));
        $product->category_id =  $request->input('product_category');
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->video = $request->input('product_video_url');
        $product->description = $request->input('product_description');
        $product->color = $request->input('color2');
        if ($product->save()){
            return redirect()->route('productDetail',$product->id);
        }else
        {
            return redirect()->back();
        }
    }
    public function removeProduct($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }
    ///*** Product Section | Functions Ends Here  ***///

    ///*** Order Section | Functions Starts Here  ***///

    public function viewOrder(){
        $orders = Order::with([
            'user','orderDetails'
        ])->orderBy('created_at','desc')->get();
        return view('backend.order.view-order',compact('orders'));
    }
    public function orderDetail($id){
        $order = Order::with([
            'user','orderDetails'
        ])->orderBy('created_at','desc')->findOrFail($id);
        return view('backend.order.order-detail',compact('order'));
    }
    ///*** Order Section | Functions Ends Here  ***///
    public function logout(){
        auth()->logout();
        return redirect()->route('adminLogin');
    }
}

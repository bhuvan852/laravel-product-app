<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\productcategory;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
class MainController extends Controller
{
    public function login()
    {
        if(Auth::check())
        {
            return redirect('adminDashboard');

        }
        else{

        return view('frontend.login');
    }

    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('adminDashboard');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    public function adminDashboard()
    {

        return view('frontend.adminDashboard');

    }

    


    public function signup()
    {
        return view('frontend.signup');
    }

     public function signUpStore(Request $request)
    {
        $this->validate($request,[
            'password'=>'min:6',
            'confirm_password'=>'required_with:password|same:password|min:6'
        ]);

        //   $this->validate($request,[
        //     'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

        DB::transaction(function() use($request) {
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->user_type="admin";
        $user->save();
        Session::flash('flash_success','SignUp Successfull !!!');
        });
        return redirect('/');
    }

     public function category()
    {
        $data=Category::get();
        return view('frontend.category',compact('data'));
    }

    

     public function categoryStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        DB::transaction(function() use($request) {
            $file=$request->file('image');
        if($file)
        {
        $file_name=$file->getClientOriginalName();
        // $file_ext=$file->getClientSize();
        $file->move(public_path('category'),$file_name);
        }
        $category=new Category;
        $category->category_name=$request->name;
        $category->category_image =$file_name;
        $category->save();
        Session::flash('flash_success','Created Successfull !!!');
        });
        return redirect()->back();
    }

       public function categoryDelete($id)
    {
        Category::findorFail($id)->delete();
        Session::flash('flash_success','Deleted Successfull !!!');
        return redirect()->back();
    }
        public function productDelete($id)
    {
        productcategory::findorFail($id)->delete();
        Session::flash('flash_success','Deleted Successfull !!!');
        return redirect()->back();
    }
    

     public function product()
    {
     
        $category=Category::pluck('category_name','id');
        $data=productcategory::get();
        return view('frontend.product',compact('data','category'));
    }

    

     public function productStore(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        DB::transaction(function() use($request) {
            $file=$request->file('image');
        if($file)
        {
        $file_name=$file->getClientOriginalName();
        // $file_ext=$file->getClientSize();
        $file->move(public_path('product'),$file_name);
        }
        $product=new productcategory;
        $product->category_id=$request->category_id;
        $product->product_name=$request->name;
        $product->product_image =$file_name;
        $product->price ='100';
        $product->save();
        Session::flash('flash_success','Created Successfull !!!');
        });
        return redirect()->back();
    }

    function logout()
    {
     Auth::logout();
     return redirect('/');
    }


}

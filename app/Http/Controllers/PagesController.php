<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use App\ProductModel;
use App\CommentModel;
use App\ReplyComment;
use App\CustomerModel;
use App\FeeShipModel;
use App\CityModel;
use App\DistrictModel;
use App\CommuneModel;
use App\ShippingModel;
use App\OrderModel;
use App\OrderDetailsModel;
use App\PaymentModel;
use Str;
use Cart;
use View;
use Session;

class PagesController extends Controller
{
    function __construct(){
        $category = CategoryModel::all();
        View::share('category',$category);
    }
    public function getHome(){
        $listproduct = ProductModel::paginate(15);
        return view('frontend.pages.trangchu',compact('listproduct'));
    }
    public function getDetails($idProduct){
        $details = ProductModel::find($idProduct);
        $comment = CommentModel::where('product_id',$idProduct)->get();
        $replay = ReplyComment::all();
        
        return view('frontend.pages.chitietsanpham',compact('details','comment','replay'));
    }
    public function getShowCart($idProduct){
        $product = ProductModel::find($idProduct);
        Cart::add(
            [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' =>$product->product_price,
                'weight'=>0,
                'options' => ['image' => $product->product_image]
            ]
        );
        return redirect()->back();
    }
    public function getDelCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
    public function getCategory($category_id){
        $ctg = ProductModel::where('category_id',$category_id)->paginate(15);
        return view('frontend.pages.danhmucsanpham',compact('ctg'));
    }
    public function getViewCart(){
      
        return view('frontend.pages.giohang');
    }
    public function getLogin(){
        return view('frontend.pages.dangnhap');
    }
    public function postLogin(Request $rq){
        $this->validate($rq,
        [
            "customer_email"=>'required|min:5|max:30',
            "customer_password"=>'required'
        ],
        [
            "customer_email.required"=>'Email bắt buộc phải nhập',
            "customer_email.min"=>'Email ít nhất 5 ký tự',
            'customer_email.max'=>'Email lớn nhất 30 ký tự'
        ]);
        $password = md5($rq->customer_password);
        $customer = CustomerModel::where('customer_email',$rq->customer_email)->where('customer_password',$password)->first();
        if($customer && $customer->customer_status == 1){
            Session::put('cm_name',$customer->customer_name);
            Session::put('cm_id',$customer->customer_id);
            return redirect('/home')->with('message','Đăng nhập thành công!');
        }else{
            return redirect()->back()->with('error','Sai tên tài khoản hoặc mật khẩu!');
        }
    }
    public function getRegister(){
        return view('frontend.pages.dangky');
    }
    public function postRegister(Request $rq){
        $this->validate($rq,
        [
            'customer_email'=>'required|min:5|max:30|email',
            'customer_password'=>'required',
            'customer_name'=>'required',
            'customer_passwordAgain'=>'required|same:customer_password',
            'customer_phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|numeric'
        ],
        [
            'customer_email.required'=>'Email bắt buộc phải nhập',
            'customer_email.min'=>'Email ít nhất 5 ký tự',
            'customer_email.max'=>'Email lớn nhất 30 ký tự',
            'customer_name.required'=>'Tên không được bỏ trống!',
            'customer_passwordAgain.required'=>'Mật khẩu không được bỏ trống!!!',
            'customer_passwordAgain.same'=>'Mật khẩu nhập lại không đúng!!',
            'customer_phone.required'=>'Số điện thoại không được bỏ trống!!!',
            'customer_phone.regex'=>'Ký tự đầu tiên phải là 0',
            'customer_phone.min'=>'Số điện thoại nhỏ nhất phải từ 10 số trở lên',
            'customer_phone.numeric'=>'Số điện thoại phải là số'
        ]);
        $cm = new CustomerModel;
        $cm->customer_name  = $rq->customer_name;
        $cm->customer_email = $rq->customer_email;
        $cm->customer_password = md5($rq->customer_password);
        $cm->customer_phone = $rq->customer_phone;
        $cm->customer_status = 1;
        $cm->save();
        return redirect()->back()->with('message','Đăng ký thành công!!!');
    }
    public function getLogOut(){
        Session::forget('cm_id');
        Session::forget('cm_name');
        return redirect('/home');
    }
    public function getCheckOut(){
        $city = CityModel::all();
        return view('frontend.pages.thanhtoan',compact('city'));
    }
    public function postUpdateCart(Request $rq){
        $pd  = ProductModel::find($rq->idProduct);
        if($rq->action == "add"){
            if($pd->product_quantity < $rq->qty){
                return response(["errors"=>"Sản phẩm không đủ số lượng đáp ứng"]);
            }else{
                Cart::update($rq->rowId,$rq->qty + 1);
            }
        }else if($rq->action == "sub"){
            Cart::update($rq->rowId,$rq->qty - 1);
        }
            
    }
    public function postCharge(Request $rq){
        $output="";
        if($rq->action){
            if($rq->action == "Tinh"){
                $qh = DistrictModel::where('matp',$rq->matp)->get();
                foreach($qh as $value){
                    $output.='<option value="'.$value->maqh.'">'.$value->name_quanhuyen.'</option>';
                }
            }else{
                $xa = CommuneModel::where('maqh',$rq->matp)->get();
                foreach($xa as $value){
                    $output.='<option value="'.$value->xaid.'">'.$value->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
        if($rq->actionpvc){
            $fee = FeeShipModel::where('matp',$rq->matp)->where('maqh',$rq->maqh)->where('xaid',$rq->xaid)->first();
            Session::put('fee_ship',$fee->fee_feeship);
        }
    }
    public function postCheckOut(Request $rq){
        // Kiểm lỗi
        $this->validate($rq,
        [
            "Ten" => 'required',
            "DiaChi"=>'required',
            "SoDienThoai"=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|numeric', 
            "Email" =>"email|required",
            "GhiChu" =>'required',
            "Payment"=>'required',
        ],
        [
            "Ten.required"=>'Tên người nhận không được bỏ trống!!!',
            "DiaChi.required"=>"Địa chỉ không được bỏ trống!!!",
            "SoDienThoai.required"=>"Số điện thoại không được trống",
            "SoDienThoai.regex"=>"Số điện thoại phải bắt đầu bằng số 0",
            "SoDienThoai.min"=>"Số điện thoại phải từ 10 đến 11 số",
            "SoDienThoai.numeric"=>"Số điện thoại phải là số",
            "Email.email"=>"Bạn nhập sai định dạng email",
            "GhiChu.required"=>"Ghi chú giao hàng không được bỏ trống",
            "Payment.required"=>"Phương thức thanh toán không được bỏ trống!!!",
        ]
        );
        // Phí vận chuyển
        if(Session::get('fee_ship')){
            $fee = Session::get('fee_ship');
             // Giỏ hàng người dùng
            $cartItem = Cart::content();
            $PriceTotal = Cart::total();
            // người nhận hàng
            $shipping = new ShippingModel;
            $shipping->shipping_name = $rq->Ten;
            $shipping->shipping_address = $rq->DiaChi;
            $shipping->shipping_phone = $rq->SoDienThoai;
            $shipping->shipping_email = $rq->Email;
            $shipping->shipping_notes = $rq->GhiChu;
            $shipping->save();
            // Mã hoá đơn
            $order_code = Str::random(5);
            // Phương thức thanh toán
            $payment = new PaymentModel;
            $payment->payment_method = $rq->Payment;
            $payment->payment_status = "Đang xử lý";
            $payment->save();
            // Hoá đơn
            $order = new OrderModel;
            $order->customer_id = Session::get('cm_id');
            $order->shipping_id = $shipping->shipping_id;
            $order->payment_id = $payment->payment_id;
            $order->order_code = $order_code;
            $order->order_status = 1;
            $order->order_total =  $PriceTotal;
            $order->save();
            // Chi tiết hoá đơn
            foreach($cartItem as $key => $value){
                $order_details = new OrderDetailsModel;
                $product_qty = ProductModel::find($value->id);
                $order_details->product_id = $value->id;
                $order_details->product_name = $value->name;
                $order_details->product_price = $value->price;
                $order_details->product_sales_quantity = $value->qty;
                $order_details->product_feeship = $fee;
                $order_details->order_code = $order_code;
                $product_qty->product_quantity = $product_qty->product_quantity - $value->qty;
                $order_details->save();
                $product_qty->save();
            }
            Session::forget('fee_Ship');
            Cart::destroy();
            return view('frontend.pages.thanhcong',compact('order_code'));
        }else{
            return redirect()->back()->with('error','Bạn chưa chọn phí vận chuyển');
        }
       
    }
    public function getComplete(){
        return view('frontend.pages.thanhcong');
    }
    public function pagenotfound(){
        return view('frontend.pages.404');
    }
}

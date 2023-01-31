<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">    

</head>
<body>
   <div class="testMail" style="width: 500px; margin: 0 auto; padding: 15px; text-align: center;">
      <div class="content" style=" margin: 0 auto; max-width: 600px; display: block; font-family: inherit;">
       <h2>xin chào! {{$user->name}}</h2>
         <p>Vui lòng lựa chọn nút bên dưới để xác minh địa chỉ email <span style="color:blue; font-weight: bold;">Tài Khoản Website Tin Tức</span> của bạn. 
            Việc xác minh địa chỉ email sẽ đảm bảo thêm một lớp bảo mật cho tài khoản của bạn. 
            Cung cấp thông tin chính xác sẽ giúp bạn nhận được hỗ trợ về tài khoản dễ dàng hơn khi cần 
         </p>
         <a href="{{$url}}" class="button1">
            <button style="padding: 2px;
               outline: 0;
               font-size: 17px;
               color: rgb(255, 255, 255);
               background: -webkit-gradient(
               linear,
               left top,
               right top,
               from(#fdde5c),
               color-stop(#f8ab5e),
               color-stop(#f56a62),
               color-stop(#a176c8),
               color-stop(#759beb),
               color-stop(#65beb3),
               to(#70db96)
               );
               background: linear-gradient(
               to right,
               #fdde5c,
               #f8ab5e,
               #f56a62,
               #a176c8,
               #759beb,
               #65beb3,
               #70db96
               );
               border-radius: 30px;
               border: 0;
               box-shadow: none;
               cursor: pointer;"
               >
            <span class="btn1" style="display: block;
               padding: 10px 20px;
               font-size: 17px;
               background: linear-gradient(
               to right,
               #fdde5c,
               #f8ab5e,
               #f56a62,
               #a176c8,
               #759beb,
               #65beb3,
               #70db96
               );
               border-radius: 30px;"
            >Xác minh địa chỉ Email
            </span>               
            </button>
         </a>
      </div>
   </div>
</body>
</html>
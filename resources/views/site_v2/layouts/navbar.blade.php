    <div class="d-flex justify-content-between text-center ltr">
        <div class=" mt-3 ">
            <!-- <a href="#"> <img class=" menu " src="./img/Menu.svg" alt="menu"></a> -->
            <div id="mySidenav" class="sidenav text-center @if(request()->is('/'))@else mt-7 @endif"  style="z-index: 98999">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="/">الرئيسية</a>
                <a href="/coupons">تصفح الكوبونات</a>
                <a href="/privacy">سياسة الخصوصية</a>

            </div>

            <div id="main">

                <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
            </div>

        </div>
        <div class="logo mt-2 ">
          <img class="logo " src="{{ asset('site/site/img/qasima-logo.png') }}" alt="قسيمه">
        </div>
    </div>


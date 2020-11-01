<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .modal-content{
            opacity: 0;
            visibility: hidden;
            /*height: 0;*/
            /*width: 0;*/
                position: fixed;
            top: 50%;
            left: 50%;
            transform:scale(.9) translate(-50%, -50%) !important;
            transition: all .3s;
            max-width: 400px;
        }
        .modal-show{
            opacity: 1;
            visibility: visible;
            height: auto;
            transform: scale(1) translate(-50%, -50%) !important;
            width: 100%;
        }
        .overlay-edit-modal{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(0 0 0 / 0.35);
        }
        .overlay-show	{
            display: block;
        }

        .show#addContact .modal-content{
        opacity: 1;
        visibility: visible;
        }
        </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                <img src="{{asset('logo.png')}}" width="100px" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}


                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">


$(document).on('click', '#editButton' , function(){
    var editTableNode = $(this).parent('td').parent('tr');
    $.fn.appendAttr = function(attrName, suffix) {
    this.attr(attrName, function(i, val) {
        return val + suffix;
    });
    return this;
};
    var editNameField = editTableNode.children()[0].innerHTML;
    var editEmailField = editTableNode.children()[1].innerHTML;
    var editEhoneField = editTableNode.children()[2].innerHTML;
    $('#editModal').find('#name').val(editNameField);
    $('#editModal').find('#email').val(editEmailField);
    $('#editModal').find('#phone').val(editEhoneField);
     $('#editModal form').appendAttr('action', 41);

    modalToggle();
    // console.log(editNameField);

});
function modalToggle() {
	$('#editModal').toggleClass('modal-show');
	$('.overlay-edit-modal').toggleClass('overlay-show');
};



          function deleteUser(id){
             if(confirm('Are you sure you want to delete?')){
                window.location.href='{{url('admin/users/delete')}}/'+id;
             }
          };



//    $('#contactNam1').on('change',function(){
    //$('#contactName').on('change', function() {
        function onSelectChange(sel) {
        console.log(sel.value);

       let id = sel.value;

    //       $('#numberInput').empty();
    //    $('#numberInput').append('<option value="0" disabled selected>Processing...</option>');

       $.ajax({
        type: 'GET',
        url: '{{url('admin/users/getnumber')}}/' +id,

        success: function(response){
            console.log('alskdf');
           // alert(response);
            var response = JSON.parse(response);
            console.log(response);

            $('#numberInput').empty();
            response.forEach(element =>{
                $('#numberInput').val(`${element['phone']}`);
                // .append(
                //     `
                //     <option value="${element['id']}">${element['phone']}</option>
                //     `

                    // );
            });
        }
       });

        }

  // });

  function onSelectChangeEmail(sel) {
        console.log(sel.value);

       let id = sel.value;

    //       $('#numberInput').empty();
    //    $('#numberInput').append('<option value="0" disabled selected>Processing...</option>');

       $.ajax({
        type: 'GET',
        url: '{{url('admin/users/getemail')}}/' +id,

        success: function(response){
            console.log('alskdf');
           // alert(response);
            var response = JSON.parse(response);
            console.log(response);

            $('#emailInput').empty();
            response.forEach(element =>{
                $('#emailInput').val(`${element['email']}`);
                // .append(
                //     `
                //     <option value="${element['id']}">${element['phone']}</option>
                //     `

                    // );
            });
        }
       });

    }

    $('#user_type_upload_file').hide();
    $('#user_type_contacts').hide();
    function handleOnChangeUserType(option)
    {
        if(option){
            if(option == 'upload_file'){
                $('#user_type_upload_file').show();
                $('#user_type_contacts').hide();
            }
            if(option == 'contacts'){
                $('#user_type_contacts').show();
                $('#user_type_upload_file').hide();
            }
        }
    }

    $('#schedule_date_time').hide();
    function handleOnChangeSchedule(option)
    {
        if(option){
            if(option == 'mark_schedule'){
                $('#schedule_date_time').show();
            } else {
                $('#schedule_date_time').hide();
            }
        }
    }

    $('#template_message').hide();
    function handleOnChangeMessage(option)
    {
        if(option){
            if(option == 'template_message'){
                $('#template_message').show();
            } else {
                $('#template_message').hide();
            }
        }
    }

    function handleOnChangeTemplate(template)
    {
        if(template){
            $.ajax({
                type: 'GET',
                url: '{{url('admin/users/template')}}/' +template,
                success: function(response){
                    $('#custom_message').val(response.text);
                }
            });
        }        
    }

</script>
</html>






{{-- DB_DATABASE=u136596284_smsbulkdb
DB_USERNAME=u136596284_demoroot
DB_PASSWORD=Demo@root123 --}}

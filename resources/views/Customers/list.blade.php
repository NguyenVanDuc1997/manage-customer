@extends('master')
@section('title','Danh sach khach hang')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12"><h1>Dan sach khach hang</h1></div>
            <div class="col-12">
                @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="text-success">
                        <i class="fa fa-check"
                           aria-hidden="true"></i>{{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                @endif
            </div>

            <div class="col-6">

                <form class="navbar-form navbar-left" action="{{route('customers.search')}}" method="get">

                    @csrf

                    <div class="row">

                        <div class="col-8">

                            <div class="form-group">

                                <input type="text" name="keyword" class="form-control" placeholder="Search">

                            </div>

                        </div>

                        <div class="col-4">

                            <button type="submit" class="btn btn-default">Tìm kiếm</button>

                        </div>

                    </div>

                </form>

            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>

                    <th scope="col">Email</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Tỉnh thành</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($customers)==0)
                    <tr>
                        <td colspan="4"> Khong co du lieu</td>
                    </tr>
                @else
                    @foreach($customers as $key => $customer)
                        <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->dob}}</td>
                            @if(isset($customer->city->name))
                                <td>{{$customer->city->name }}</td>
                            @else
                                <td>Chua phan loai</td>
                            @endif
                            <td><a href="{{route('customers.edit',$customer->id)}}">Sua</a></td>
                            <td><a href="{{route('customers.destroy',$customer->id)}}" class="text-danger"
                                   onclick="return confirm('Ban chac chan muon xoa?')">Xoa</a></td>
                        </tr>
                    @endforeach
                @endif
                <tr>

                </tr>
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{route('customers.create')}}">Them moi</a>

            <a class="btn btn-primary" href="{{route('cities.index')}}">Danh sach cac tinh</a>

            {{ $customers->appends(request()->query())}}
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title',trans_choice('labels.models.content',2))

@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0"> About Us</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">{{__('labels.fields.dashboard')}}</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    About Us
                                </li>

                                <li class="breadcrumb-item active">
                                    Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <div class="row" id="table-head">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header ">
                            <div>
                                @can('create-content')
                                <a title="{{__('messages.static.create')}}" id="create-btn" href="{{route('admin.details.create')}}" class="btn btn-icon btn-outline-primary">
                                    <i data-feather="plus"></i> Add
                                </a>
                                @endcan
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="card-tools">
                                <form id="filter-form">
                                    <div class="row justify-content-end">
                                        @include('admin.layouts.partials.search')

                                        <div class="form-group mr-1 mt-2">
                                            <button type="submit" class="btn btn-success">{{__('search')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 20%">#</th>
                                            <th scope="col" style="width: 20%">title</th>
                                            <th scope="col" style="width: 20%">discription</th>
                                            <th scope="col" style="width: 20%">icon</th>
                                            <th scope="col" style="width: 20% ;text-align: center">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($abouts as $about)
                                        <tr>
                                            <?php $i++; ?>
                                            <td style="width: 20%">{{ $i }}</td>
                                            <td style="width: 20%">{{$about->title}}</td>
                                            <td style="width: 20%">{{$about->discription}}</td>
                                            <td style="width: 20%"><i class="fa fa-{{$about->icon}}"></i></td>
                                            <td>
                                                <div class="row wow fadeInUp" style="justify-content: center ">
                                                    <span style="padding-left: 2%">
                                                        <a class="btn btn-primary" href="{{route('admin.details.edit', $about->id)}}" role="button"><i class="mr-50 fas fa-edit"></i></a>
                                                    </span>


                                                    <span style="padding-left: 2%">
                                                        <form action="{{route('admin.details.destroy',$about->id)}}" method="post">

                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"> <i class="mr-50 fas fa-trash"></i></button>
                                                        </form>
                                                    </span>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@can('delete-content')
@include('admin.layouts.partials.delete', ['route' => '/admin/contents/'])
@endcan

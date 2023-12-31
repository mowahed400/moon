@extends('admin.layouts.app')

@section('title',trans_choice('labels.models.content',2))

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endpush

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Clients</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.fields.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                         Clients
                                    </li>

                                    <li class="breadcrumb-item active">
                                       Add
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row" id="table-head">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <button title="{{__('messages.static.back')}}" onclick="document.location = '{{url()->previous()}}'" type="button" class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i> back
                                </button>

                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add New</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post" action="{{route('admin.client.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6" >
                                                    <div class="form-group" >
                                                        <label for="section">Name
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"  name="name" id="category_id" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label for="logo">Logo
                                                        <span class="text-danger">*</span>
                                                    </label>


                                                    <div class="custom-file">
                                                        <label for="file" class="custom-file-label" > </label>
                                                        <input type="file" name="logo" id="file" class="custom-file-input"  >
                                                    </div>
                                                </div><br><br>

                                                <div class="col-sm-9 offset-sm-3 mt-2">
                                                    <button type="submit" class="btn btn-primary mr-1">{{__('messages.static.save')}}</button>
                                                    <button type="reset" class="btn btn-outline-secondary">{{__('messages.static.reset')}}</button>
                                                </div>
                                            </div>
                                        </form>
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

@push('js')
    <script src="{{asset('assets/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2()
    </script>
    <script>
        let starLoading = containerId =>
        {
            $(`#${containerId}`).append(
                `  <span class="spinner-border spinner-grow-sm  text-primary" id="loading-${containerId}" role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </span>`
            );
        }

        let stopLoading = (containerId) =>
        {
            $(`#loading-${containerId}`).remove()
        }

        let selectCategories = () => {
            let $id = $('#section').find(":selected").val();
            if ($id) {
                starLoading('category_id_label')

                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: `/admin/sections/${$id}/categories`,
                    success: function ({categories}) {
                        $('#category_id').empty();

                        $('#category_id').append(
                            `<option value="">--{{__('labels.fields.main')}}--</option>`
                        );


                        let childrenNumbers = 0 ;
                        for (let i = 0; i < categories.length; i++) {
                            if(categories[i].parent_id != null){
                                $('#category_id').append(
                                    `<option value="${categories[i].id}">${categories[i].name.ar}</option>`
                                );
                                childrenNumbers  = childrenNumbers + 1;
                            }
                            if(childrenNumbers == 0){
                                $('#category_id').append(
                                    `<option value="${categories[i].id}">${categories[i].name.ar}</option>`
                                );
                            }
                        }
                        stopLoading('category_id_label');
                    },
                    error: function (error) {
                        stopLoading('category_id_label');
                    }
                });
            }
        }

        selectCategories();
        $(document).on('change', '#section', function (e) {
            selectCategories();
        });


    </script>
@endpush

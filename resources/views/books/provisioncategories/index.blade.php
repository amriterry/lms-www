@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Provision Categories</h2><br>

                @include('partials.messagebag')

                @can('save-provision-category')
                    <div class="row">
                        <div class="jumbotron">
                            <form action="{{ route('provisioncategories.store') }}" method="POST">
                                @include('partials.books.provisioncategories.save')
                            </form>
                        </div>
                    </div>
                @endcan

                <h3 class="text--center">Provision Category List</h3>

                @if(count($provisionCategories))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($provisionCategories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    @can('save-provision-category')
                                        <a href="{{ route('provisioncategories.edit',['provisioncategories' => $category->id]) }}"
                                       class="btn btn-warning">Edit</a>
                                    @endcan

                                    @can('delete-provision-category')
                                        <form action="{{ route('provisioncategories.destroy',['provisioncategories' => $category->id]) }}" method="POST" style="display: inline-block;">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="_method" value="delete">

                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h4 class="text--center">
                    There are no provision categories currently.
                </h4>
            @endif
        </div>
    </div>
@endsection

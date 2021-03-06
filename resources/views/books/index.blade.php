@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Book list
                    @can('save-book')
                        <small>
                                <a href="{{ route('books.create') }}">Create a new book</a>
                        </small>
                    @endcan
                </h2>
                <br>

                @include('partials.messagebag')

                @if(count($books))
                    <div class="table-responsive">
                        <table class="table table-stripped" style="font-size:0.9em;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Isbn</th>
                                    <th>Edition</th>
                                    <th>Publication</th>
                                    <th>Category</th>
                                    <th>No of Copies</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->book_name }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ ordinal_suffix(intval($book->edition)) }} Edition</td>
                                        <td>{{ $book->publication_name }}</td>
                                        <td>{{ $book->category_name }}</td>
                                        <td>{{ $book->copy_count }}</td>
                                        <td>
                                            <a href="{{ route('books.show',['books' => $book->id]) }}" class="btn btn-primary btn-block">View</a><br />
                                            @can('save-book')
                                                <a href="{{ route('books.edit',['books' => $book->id]) }}" class="btn btn-warning btn-block">Edit</a><br />
                                            @endcan

                                            @can('delete-book')
                                                <form action="{{ route('books.destroy',['books' => $book->id]) }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="_method" value="delete">

                                                    <button type="submit" class="btn btn-danger btn-block">
                                                        Delete
                                                    </button>
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
                    There are no books currently.
                </h4>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $book->book_name }} <small><a href="{{ route('books.edit',['books' => $book->id]) }}">Edit?</a></small></h3>

                <p>
                    <strong>ISBN: </strong> {{ $book->isbn }}
                </p>

                <p>
                    <strong>Edition: </strong> {{ $book->edition }}
                </p>
                <p>
                    <strong>Publication: </strong> {{ $book->publication_name }}
                </p>

                <strong>Copies: </strong> <br />

                @include('partials.messagebag')

                <form action="{{ route('books.copies.store',['books' => $book->id]) }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group form-inline">
                        <input type="numeric" name="copy_id" class="form-control" style="max-width:200px;" placeholder="Copy Id">
                        <input type="submit" value="Add Another Copy" class="btn btn-primary">
                    </div>
                </form>

                @if(count($book->copies))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Copy Id</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->copies as $copy)
                                    <tr>
                                        <td>{{ $copy->copy_id }}</td>
                                        <td>Status</td>
                                        <td>
                                            <form action="{{ route('books.copies.destroy',['books' => $book->id,'copies' => $copy->copy_id]) }}" method="post">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="_method" value="delete">

                                                <input type="submit" value="Delete?" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <br>
                    <br>
                    <h4 class="text--center">
                        There are no copies for this book. Add at least one.
                    </h4>
                @endif
            </div>
        </div>
    </div>
@endsection

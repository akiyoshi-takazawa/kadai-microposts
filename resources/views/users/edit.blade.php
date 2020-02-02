@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @if (Auth::id() == $user->id)
                <h3>ユーザー名変更</h3>
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                <br>
                <br>
                <h3>ユーザーアカウントを削除</h3>
                {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除する', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                
            @endif
            
        </div>
    </div>
@endsection
 

@extends('layout/main')

@section('content')

  <br>
    {{ Html::link('member/create','Register',array('class' => 'btn btn-primary')) }}<br>
    <form class="form-horizontal" role="form" method="POST" action="{{ action('LoginController@login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Name</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-4 control-label">Password</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Register
                      </button>
                  </div>
              </div>
        </form>

    {{-- <br><table class="table table-bordered">
      <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Blood</th>
            <th>birthyear</th>
            <th>phone</th>
            <th>province</th>
            <th>countdonate</th>
            <th>Image</th>
            <th>Updated at</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($member as $m)
          <tr>
            <th>{{ $m['id'] }}</th>
            <th>{{ $m['name'] }}</th>
            <th>{{ $m['email'] }}</th>
            <th>{{ $m['password'] }}</th>
            <th>{{ $m['blood'] }}</th>
            <th>{{ $m['birthyear'] }}</th>
            <th>{{ $m['phone'] }}</th>
            <th>{{ $m['province'] }}</th>
            <th>{{ $m['countdonate'] }}</th>
            <th>{{ $m['Image'] }}</th>
            <th>{{ $m['updated_at'] }}</th>
            <th>{{ $m['created_at'] }}</th>
          </tr>
        @empty
          <tr>
            no data!!
          </tr>
        @endforelse

      </tbody>
    </table> --}}

  @endsection

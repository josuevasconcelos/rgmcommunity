<?php
    $roles = \App\Role::all();
?>

@extends('layouts.app')

@section('form')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="/uploads/avatars/default.jpg" class="user">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age') }}" required autofocus>

                                @if ($errors->has('age'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cellphoneNumber" class="col-md-4 col-form-label text-md-right">{{ __('Cellphone Number') }}</label>

                            <div class="col-md-6">
                                <input id="cellphoneNumber" type="text" class="form-control{{ $errors->has('cellphoneNumber') ? ' is-invalid' : '' }}" name="cellphoneNumber" value="{{ old('cellphoneNumber') }}" required autofocus>

                                @if ($errors->has('cellphoneNumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cellphoneNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" required autofocus>

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="communityRGM" class="col-md-4 col-form-label text-md-right">{{ __('Community RGM') }}</label>

                            <div class="col-md-6">
                                <input id="communityRGM" type="text" class="form-control{{ $errors->has('communityRGM') ? ' is-invalid' : '' }}" name="communityRGM" value="{{ old('communityRGM') }}" required autofocus>

                                @if ($errors->has('communityRGM'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('communityRGM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="otherInformation" class="col-md-4 col-form-label text-md-right">{{ __('Other Information') }}</label>

                            <div class="col-md-6">
                                <input id="otherInformation" type="text" class="form-control{{ $errors->has('otherInformation') ? ' is-invalid' : '' }}" name="otherInformation" value="{{ old('otherInformation') }}" required autofocus>

                                @if ($errors->has('otherInformation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('otherInformation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') }}" required autofocus>

                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="typeOfPatient" class="col-md-4 col-form-label text-md-right">{{ __('Type of Patient') }}</label>

                            <div class="col-md-6">
                                <input id="typeOfPatient" type="text" class="form-control{{ $errors->has('typeOfPatient') ? ' is-invalid' : '' }}" name="typeOfPatient" value="{{ old('typeOfPatient') }}" required autofocus>

                                @if ($errors->has('typeOfPatient'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('typeOfPatient') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role_id">
                                    @foreach($roles as $role)
                                        @if($role->description == 'User' || $role->description == 'Patient')
                                            <option value="{{ $role->id }}">{{ $role->description }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('role_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
